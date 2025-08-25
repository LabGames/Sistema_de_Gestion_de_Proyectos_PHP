<?php
class Router
{
    private $pdo;
    private $publicRoutes = ['Login', 'Registro', ''];
    private $privateRoutes = ['Home', 'Logout', 'Dash', 'Usuarios', 'Rol'];

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
        require_once __DIR__ . "/Controllers/HomeController.php";
        require_once __DIR__ . "/Controllers/UserController.php";
        require_once __DIR__ . "/Controllers/RolController.php";
        $controller = new AuthController($this->pdo);
        $HomeController = new HomeController($this->pdo);
        $UserController = new UserController($this->pdo);
        $rolController = new RolController($this->pdo);

        if (in_array($url, $this->privateRoutes) && !$this->isAuthenticated()) {
            header("Location: " . BASE_URL . "/Login");
            exit;
        }

        switch ($url) {
            case '':
                $controller->welcome();
                break;
            case 'Login':
                $controller->index();
                break;
            case 'Login/Ingresar':
                $controller->login();
                break;
            case 'Registro':
                $controller->index_registro();
                break;
            case 'Registro/Crear':
                $controller->register();
                break;
            case 'Home':
                $HomeController->index();
                break;
            case 'Dash':
                $controller->dash();
                break;
            case 'Logout':
                $controller->logout();
                break;
            case 'Usuarios':
                $UserController->index();
                break;
            case 'Usuarios/Listar':
                $UserController->listar();
                break;
            case 'Usuarios/Registrar':
                $UserController->listar();
                break;
            case 'Rol/Listar':
                $rolController->listar();
                break;
            case 'CreateNewProyect':
                $controller->new_proyect();
                break;
            case 'ManageCollaborators':
                $controller->admin_collab();
                break;
            case 'ManageManagers':
                $controller->admin_manager();
                break;
            default:
                echo "404 - Página no encontrada";
        }
    }
}
