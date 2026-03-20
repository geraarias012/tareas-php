<?php include("db.php"); ?>

<form method="POST">
    <label for="nombre">Nombre de la tarea:</label>
    <input type="text" id="nombre" name="title" placeholder="Nombre de la Tarea">
    <br>
    <label for="description">Descripción:</label>
    <input type="text" id="description" name= "description" placeholder="Descripción">
    <br>
    <button type="button" onclick="window.location.href='index.php'">Regresar</button>
    <button type="submit">Guardar</button>
</form>

<?php
if ($_POST) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!empty($title) && !empty($description)) {
        $conn->query("INSERT INTO tasks (title, description) VALUES ('$title', '$description')");
        
        header("Location: index.php");
        exit();
    }
}
?>