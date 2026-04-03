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


$conn->query("UPDATE tasks SET status= 1 - status WHERE id = $id and user_id = " . $_SESSION['user_id']);
header("Location: index.php");
exit();

?>