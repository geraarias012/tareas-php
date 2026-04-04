<?php include("db.php");

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
        alert('Debes de iniciar sesión');
        window.location='login.php';
        </script>";
    exit();
}

include("includes/header.php");

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="es">
<body class="bg-dark bg-opacity-75">

    <div class="container mt-4">

        <?php
        $user_id = $_SESSION['user_id'];

        $total_task = $conn->query("SELECT COUNT(*) AS total FROM tasks WHERE user_id = $user_id")->fetch_assoc()['total'];
        $completed_tasks = $conn->query("SELECT COUNT(*) AS completed FROM tasks WHERE user_id = $user_id AND status = 1")->fetch_assoc()['completed'];
        $incomplete_tasks = $total_task - $completed_tasks;

        $progress = $total_task > 0 ? ($completed_tasks / $total_task) * 100 : 0;
        ?>

        <!-- CARDS -->
        <div class="row mb-4 text-center">

            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 bg-primary text-white">
                    <div class="card-body">
                        <h2><?= $total_task ?></h2>
                        <p class="mb-0">Total de tareas</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 bg-warning text-dark">
                    <div class="card-body">
                        <h2><?= $incomplete_tasks ?></h2>
                        <p class="mb-0">Pendientes</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 bg-success text-white">
                    <div class="card-body">
                        <h2><?= $completed_tasks ?></h2>
                        <p class="mb-0">Completadas</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- PROGRESS BAR -->
        <div class="mb-5">
            <label class="form-label fw-semibold text-white">Progreso</label>
            <div class="progress" style="height: 25px;">
                <div 
                    class="progress-bar bg-success fw-bold" 
                    role="progressbar" 
                    style="width: <?= $progress ?>%;">
                    <?= round($progress) ?>%
                </div>
            </div>
        </div>

        <h2 class="mb-3 color text-white">Lista de tareas</h2>
        <a href="create.php" class="btn btn-success mb-3">Crear tarea</a>

        <?php
        $result = $conn->query("SELECT * FROM tasks WHERE user_id = $user_id");

        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):

                $task_id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $status = $row['status'];
        ?>

            <div class="card shadow-sm mb-3 bg-dark bg-opacity-75">
                <div class="card-body">

                    <?php if ($status == 1): ?>
                        <h5 class="card-title text-white"><s><?= $title ?></s></h5>
                        <p class="card-text text-white"><s><?= $description ?></s></p>
                    <?php else: ?>
                        <h5 class="card-title text-white"><?= $title ?></h5>
                        <p class="card-text text-white"><?= $description ?></p>
                    <?php endif; ?>

                    <div class="d-flex gap-2 mt-3">

                        <?php if ($status == 0): ?>
                            <a href="toggle_status.php?id=<?= $task_id ?>" class="btn btn-warning btn-sm">Pendiente</a>
                        <?php else: ?>
                            <a href="toggle_status.php?id=<?= $task_id ?>" class="btn btn-success btn-sm">Completada</a>
                        <?php endif; ?>

                        <a href="update.php?id=<?= $task_id ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="delete.php?id=<?= $task_id ?>" class="btn btn-danger btn-sm">Eliminar</a>

                    </div>

                </div>
            </div>

        <?php
            endwhile;
        else:
            echo "<p>No hay tareas</p>";
        endif;
        ?>

    </div>
</body>