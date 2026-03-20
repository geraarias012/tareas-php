<?php include("db.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <h1 class="text-center mb-4">Lista de tareas</h1>
    <a href="create.php" class="btn btn-primary mb-3">Crear tarea</a>    <?php
    $result = $conn->query("SELECT * FROM tasks");

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