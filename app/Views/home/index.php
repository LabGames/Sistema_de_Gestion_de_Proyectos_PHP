<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$nombre = $_SESSION['name'] ?? 'Usuario';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <title>Empresa X</title>
</head>

<body>
    <?php include_once __DIR__ . '/sidebar.php'; ?>
    <?php include_once __DIR__ . '/header.php'; ?>

    <main class="app-content">
        <h2>Bienvenido, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></h2>
    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>
</body>

</html>