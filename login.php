<?php 
include("db.php"); 
session_start();
include("includes/public_header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="es">
<body class="bg-dark bg-opacity-75">

<div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 w-75 bg-dark bg-opacity-75">
            <h2 class="mb-3 text-white">Iniciar Sesión</h2>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-white">Usuario:</label>
                    <input type="text" name="username" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Contraseña</label>
                    <input type="password" name="password_input" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <button type="submit" class="btn btn-success">Acceder</button>
                <br>
                <label class="form-label text-white">¿Aún no tienes cuenta?</label>  
                <a class="form-label" href = "register.php"> Crear una cuenta </a>
            </form>
        </div>
    </div>
</body>
<?php
if ($_POST) {

    if (!empty($_POST['username']) && !empty($_POST['password_input'])) {

        $username = $_POST['username'];
        $password_input = $_POST['password_input'];

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $password_bd = $row['password'];
            $name = $row['name'];
            $lastname = $row['lastname'];

            if (password_verify($password_input, $password_bd)) {

                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $name;
                $_SESSION['lastname'] = $lastname;

                echo "<script>
                        alert('Bienvenido $name $lastname');
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