<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
        const userId = <?= json_encode($_SESSION["user_id"] ?? null); ?>;
        const estadoCliente = <?= json_encode($_SESSION["estado_cliente"] ?? null); ?>;
    </script>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/Assets/js/login.js"></script>
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