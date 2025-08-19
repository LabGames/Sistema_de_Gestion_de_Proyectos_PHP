<?php
class Router
{
    private $pdo;
    private $publicRoutes = ['Login', 'Registro', ''];
    private $privateRoutes = ['Home', 'Logout'];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    private function isAuthenticated(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    public function dispatch($url)
    {
        require_once __DIR__ . "/Controllers/AuthController.php";
        $controller = new AuthController($this->pdo);

        if (in_array($url, $this->privateRoutes) && !$this->isAuthenticated()) {
            header("Location: " . BASE_URL . "/Login");
            exit;
        }

        switch ($url) {
            case '':
                $controller->main();
                break;
            case 'Login':
                $controller->login();
                break;
            case 'Registro':
                $controller->register();
                break;
            case 'Home':
                $controller->home();
                break;
            case 'Dashboard':
                $controller->dash();
                break;
            case 'Logout':
                $controller->logout();
                break;
            default:
                echo "404 - Página no encontrada";
        }
    }
}
