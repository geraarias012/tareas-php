<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
    exit();
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
    <a href="create.php" class="btn btn-success mb-3">Crear tarea</a>    
    <?php
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT * FROM tasks where user_id = $user_id");

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='d-flex gap-2 mt-3'>";
            echo "<div class='card-body'>";

            $task_id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $status = $row['status'];

            if ($status == 1) {
                echo "<h5 class='card-title'><s>$title</s></h5>";
            echo "<p class='card-text'><s>$description</s></p>";
            } else {
                echo "<h5 class='card-title'>$title</h5>";
            echo "<p class='card-text'>$description</p>";
            }

            if ($status == 0) {
                echo "<a href='toggle_status.php?id=$task_id' class='btn btn-warning btn-sm me-2'>🟡Pendiente</a>";
            } else {
                echo "<a href='toggle_status.php?id=$task_id' class='btn btn-success btn-sm me-2'>🟢Completada</a>";
            }
            echo "<a href='update.php?id=$task_id' class='btn btn-primary btn-sm me-2'>Editar</a>";
            echo "<a href='delete.php?id=$task_id' class='btn btn-danger btn-sm'>Eliminar</a>";

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No hay tareas";
    }

        ?>

</div>