<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TaskApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">

        <!-- Izquierda -->
        <span class="navbar-brand fw-bold">TaskApp</span>

        <!-- Derecha -->
        <div class="d-flex align-items-center gap-3">
            <?php if (isset($_SESSION['name'])): ?>
                <span class="text-white">
                    <?php echo $_SESSION['name'] . " " . $_SESSION['lastname']; ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Salir</a>
            <?php endif; ?>
        </div>

    </div>
</nav>
