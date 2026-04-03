<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
}

echo "<div class='container mt-5'>";
echo "Bienvenido, " . $_SESSION['user'];
echo "<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";
echo "</div>";

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <h1 class="text-center mb-4">Lista de tareas</h1>
    <a href="create.php" class="btn btn-primary mb-3">Crear tarea</a>    
    <?php
    $id = $_SESSION['id'];
    $result = $conn->query("SELECT * FROM tasks where user_id = $id");

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";

            echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
            echo "<p class='card-text'>" . $row["description"] . "</p>";

            echo "<a href='update.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm me-2'>Editar</a>";
            echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Eliminar</a>";

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No hay tareas";
    }

        ?>

</div>