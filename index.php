<?php include("db.php"); ?>

<h1>Lista de tareas</h1>
<button type="button" onclick="window.location.href='create.php'">Crear tarea</button>
<?php
$result = $conn->query("SELECT * FROM tasks");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<button onclick=\"window.location.href='delete.php?id=" . $row["id"] . "'\">Eliminar</button>";        
        echo "<button onclick=\"window.location.href='update.php?id=" . $row["id"] . "'\">Editar</button>";        
        echo "<hr>";
        echo "</div>";
    }
} else {
    echo "No hay tareas";
}

    ?>