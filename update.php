<?php include("db.php"); 


$id = $_GET['id'];

$result = $conn->query("SELECT * FROM tasks WHERE id=" . $id);
$row = $result->fetch_assoc();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-3">Editar tarea</h2>

        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control"><?php echo $row['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

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