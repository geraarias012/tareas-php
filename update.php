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

include("includes/header.php"); 

$row = $result->fetch_assoc();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!DOCTYPE html>
<html lang="es">
<body class="bg-dark bg-opacity-75">

    <div class="container mt-5">
        <div class="card shadow p-4 bg-dark bg-opacity-75">
            <h2 class="mb-3 text-primary">Editar tarea</h2>

            <form method="POST">

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label class="form-label text-white">Título</label>
                    <input type="text" name="title" class="form-control text-white bg-dark bg-opacity-10" value="<?php echo $row['title']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Descripción</label>
                    <textarea name="description" class="form-control text-white bg-dark bg-opacity-10"><?php echo $row['description']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>

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