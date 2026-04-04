<?php include("db.php"); 
include("includes/public_header.php");?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="es">
<body class="bg-dark bg-opacity-75">

    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 w-75 bg-dark bg-opacity-75">
            <h2 class="mb-3 text-white">Registrar Usuario</h2>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-white">Nombre</label>
                    <input type="text" name="name" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Apellido</label>
                    <input type="text" name="lastname" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Usuario</label>
                    <input type="text" name="username" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Contraseña</label>
                    <input type="password" name="password" class="form-control text-white bg-dark bg-opacity-10">
                </div>

                <button type="submit" class="btn btn-success">Registrar</button>
                <br>
                <label class="form-label text-white">¿Ya estás registrado?</label>  
                <a class="form-label" href = "login.php"> Acceder </a>
            </form>
        </div>
    </div>
</body>

<?php
if ($_POST) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($result->num_rows > 0) {

            echo "<script> alert('El nombre de usuario ya existe')</script>";

        } else {

            $conn->query("INSERT INTO users (username, password, name, lastname) VALUES ('$username', '$password', '$name', '$lastname')");
        
            header("Location: login.php");
            exit();
        }
    }
}
?>