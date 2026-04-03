<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
    exit();
}

function bloquear() {
    echo "<script>
        alert('Acción no autorizada');
        window.location='index.php';
        </script>";
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    bloquear();
}

$id = (int)$_GET['id'];

if ($id <= 0){
    bloquear();
}

$result = $conn->query("SELECT * FROM tasks WHERE id = $id and user_id = " . $_SESSION['user_id']);

if ($result->num_rows <= 0) {
    bloquear();
}

echo "<div class='container mt-5'>";
echo "Bienvenido, " . $_SESSION['user'];
echo "<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";
echo "</div>";

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
        $conn->query("UPDATE tasks SET title='$title', description='$description' WHERE id=" . $id);
        
        header("Location: index.php");
        exit();
    } else {

        echo "<script>alert('Llena todos los campos');</script>";

    }
}
?>