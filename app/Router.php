<?php
class Router
{
    private $pdo;
    private $publicRoutes = ['Login', 'Registro', ''];
    private $privateRoutes = ['Home', 
                                'Logout', 
                                'Dash', 
                                'Usuarios', 
                                'Rol',
                                'Listar_Estados',
                                'Listar_Tipos',
                                'Home/Proyectos',
                                'Home/Proyectos/Crear-Nuevo-Proyecto', 
                                'Home/Administrar-Colaboradores', 
                                'Home/Administrar-Jefes-De-Proyecto'
                            ];

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
        require_once __DIR__ . "/Controllers/ProyectController.php";
        $controller = new AuthController($this->pdo);
        $HomeController = new HomeController($this->pdo);
        $UserController = new UserController($this->pdo);
        $rolController = new RolController($this->pdo);
        $ProyectController = new ProyectController($this->pdo);

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
            case 'Home/Proyectos/Crear-Nuevo-Proyecto':
                $ProyectController->new_proyect();
                break;
            case 'Listar_Estados':
                $ProyectController->listarEstados();
                break;
            case 'Listar_Tipos':
                $ProyectController->listarTipos();
                break;
            case 'Guardando_Proyecto':
                $ProyectController->store();
                break;
            case 'Home/Proyectos':
                $ProyectController->index();
                break;
            case 'Home/Administrar-Colaboradores':
                $controller->admin_collab();
                break;
            case 'Home/Administrar-Jefes-De-Proyecto':
                $controller->admin_manager();
                break;
            default:
                echo "404 - Página no encontrada";
        }
    }
}
