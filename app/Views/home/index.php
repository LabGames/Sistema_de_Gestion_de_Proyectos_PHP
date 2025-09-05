<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="<?= BASE_URL ?>/Assets/js/login.js"></script>

    <script src="<?= BASE_URL ?>/Assets/js/script.js"></script>

    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <title>Empresa X</title>
</head>
<body>
    <?php include_once __DIR__ . '/sidebar.php'; ?>
    <?php include_once __DIR__ . '/header.php'; ?>
    <main class="app-content">
        <?php
        if (isset($view)) {
            include $view;
        }
        ?>
    </main>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>