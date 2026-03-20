<?php include("db.php"); 

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM tasks WHERE id=" . $id);
$row = $result->fetch_assoc();

?>
<form method="POST">

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label>¿Seguro que quieres eliminar: <?php echo $row["title"]; ?>?</label>
    
    <button type="button" onclick="window.location.href='index.php'">No</button>
    <button type="submit">Sí</button>

</form>

<?php 

if ($_POST){

    $id = $_POST['id'];

    $conn->query("DELETE FROM tasks WHERE id=" . $id);
    
    header("Location: index.php");
    exit();
}

?>