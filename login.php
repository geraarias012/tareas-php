<?php 
include("db.php"); 
session_start();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-3">Iniciar Sesión</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password_input" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Acceder</button>
            <br>
            <label class="form-label">¿Aún no tienes cuenta?</label>  
            <a class="form-label" href = "register.php"> Crear una cuenta </a>
        </form>
    </div>
</div>

<?php
if ($_POST) {

    if (!empty($_POST['username']) && !empty($_POST['password_input'])) {

        $username = $_POST['username'];
        $password_input = $_POST['password_input'];

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $password_bd = $row['password'];

            if (password_verify($password_input, $password_bd)) {

                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = $row['id'];

                echo "<script>
                        alert('Bienvenido $username');
                        window.location='index.php';
                      </script>";

            } else {

                echo "<script>alert('Contraseña incorrecta');</script>";

            }

        } else {

            echo "<script>alert('El usuario no existe');</script>";

        }

    } else {

        echo "<script>alert('Llena todos los campos');</script>";

    }
}
?>