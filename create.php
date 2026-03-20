<?php include("db.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-3">Crear tarea</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

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