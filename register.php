<?php include("db.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-3">Registrar Usuario</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Registrar</button>
            <br>
            <label class="form-label">¿Ya estás registrado?</label>  
            <a class="form-label" href = "login.php"> Acceder </a>
        </form>
    </div>
</div>

<?php
if ($_POST) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($result->num_rows > 0) {

            echo "<script> alert('El nombre de usuario ya existe')</script>";

        } else {

            $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        
            header("Location: login.php");
            exit();
        }
    }
}
?>