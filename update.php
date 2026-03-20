<?php include("db.php"); 

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM tasks WHERE id=" . $id);
$row = $result->fetch_assoc();

?>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="nombre">Nombre de la tarea:</label>
    <input type="text" id="nombre" name="title" value="<?php echo $row['title'] ?>">
    <br>
    <label for="description">Descripción:</label>
    <input type="text" id="description" name= "description" value="<?php echo $row['description'] ?>">
    <br>
    <button type="button" onclick="window.location.href='index.php'">Regresar</button>
    <button type="submit">Guardar</button>

</form>

<?php
if ($_POST) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!empty($title) && !empty($description)) {
        $conn->query("UPDATE tasks SET title='$title', description='$description' where id=" . $id);
        
        header("Location: index.php");
        exit();
    }
}
?>