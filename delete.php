<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
}

echo "<div class='container mt-5'>";
echo "Bienvenido, " . $_SESSION['user'];
echo "<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";
echo "</div>";


$id = $_GET['id'];

$result = $conn->query("SELECT * FROM tasks WHERE id=" . $id);
$row = $result->fetch_assoc();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow p-4 text-center">

        <h3 class="text-danger mb-3">Eliminar tarea</h3>

        <p>¿Seguro que quieres eliminar:</p>
        <strong><?php echo $row["title"]; ?></strong>

        <form method="POST" class="mt-3">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <button type="submit" class="btn btn-danger me-2">Sí, eliminar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>
</div>

<?php 

if ($_POST){

    $id = $_POST['id'];

    $conn->query("DELETE FROM tasks WHERE id=" . $id);
    
    header("Location: index.php");
    exit();
}

?>