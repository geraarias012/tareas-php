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

    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 text-center w-50 bg-dark bg-opacity-75">

            <h3 class="mb-3 text-danger">Eliminar tarea</h3>

            <p class="text-white">¿Seguro que quieres eliminar:</p>
            <strong class="text-white"><?php echo $row["title"]; ?></strong>
            <form method="POST" class="mt-3">

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-danger me-2">Sí, eliminar</button>

            </form>
        </div>
    </div>
</body>

<?php 

if ($_POST){

    $id = $_POST['id'];

    $conn->query("DELETE FROM tasks WHERE id=" . $id);
    
    header("Location: index.php");
    exit();
}

?>