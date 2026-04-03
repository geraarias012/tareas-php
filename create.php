<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
    exit();
}

echo "<div class='container mt-5'>";
echo "Bienvenido, " . $_SESSION['user'];
echo "<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";
echo "</div>";

?>

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
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($description)) {
        $conn->query("INSERT INTO tasks (title, description, user_id) VALUES ('$title', '$description', $user_id)");
        
        header("Location: index.php");
        exit();
    } else {

        echo "<script>alert('Llena todos los campos');</script>";

    }
}
?>