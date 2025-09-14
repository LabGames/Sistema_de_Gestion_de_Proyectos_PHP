<?php
class Router
{
    private $pdo;
    private $publicRoutes = ['Login', 'Registro', ''];


    private $privateRoutes = [
        'Home',
        'Logout',
        'Dash',
        'Usuarios',
        'Rol',
        'Clientes',
        'Contactos',
        'Listar_Estados',
        'Listar_Tipos',
        'Home/Proyectos',
        'Home/Proyectos/Crear-Nuevo-Proyecto',
        'Home/Administrar-Colaboradores',
        'Home/Administrar-Jefes-De-Proyecto',
        'Panel/GestorProyectos',
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
        require_once __DIR__ . "/Controllers/ClientesController.php";
        require_once __DIR__ . "/Controllers/ContactosController.php";
        require_once __DIR__ . "/Controllers/PerfilController.php";


        require_once __DIR__ . "/Controllers/ProyectController.php";
        require_once __DIR__ . "/Controllers/GestorProyectosController.php";
        require_once __DIR__ . "/Controllers/GestorTareasController.php";
        require_once __DIR__ . "/Controllers/pruebaControles.php";


        $controller = new AuthController($this->pdo);
        $HomeController = new HomeController($this->pdo);
        $UserController = new UserController($this->pdo);
        $rolController = new RolController($this->pdo);
        $clientesController = new ClientesController($this->pdo);
        $contactosController = new ContactosController($this->pdo);
        $perfilController = new PerfilController($this->pdo);


        $ProyectController = new ProyectController($this->pdo);
        $GestorProyectosController = new GestorProyectosController($this->pdo);
        $GestorTareasController = new GestorTareasController($this->pdo);
        $pruebaControles = new pruebaControles($this->pdo);


        if (in_array($url, $this->privateRoutes) && !$this->isAuthenticated()) {
            header("Location: " . BASE_URL . "/Login");
            exit;
        }

        switch ($url) {
            //Landing Page
            case '':
                $controller->welcome();
                break;
            //Login y Registro
            case 'Login':
                $controller->index();
                break;
            case 'Login/Ingresar':
                $controller->login();
                break;
            case 'Registro':
                $controller->index_registro();
                break;
            //Sistema
            //Home
            case 'Home':
                $HomeController->index();
                break;
            case 'Logout':
                $controller->logout();
                break;
            case 'Dash':
                $controller->dash();
                break;
            //Usuarios
            case 'Usuarios':
                $UserController->index();
                break;
            case 'Usuarios/Listar':
                $UserController->listar();
                break;
            case 'Usuarios/ObtenerUsuario':
                $UserController->obtenerUsuario();
                break;
            case 'Usuarios/Registrar':
                $UserController->registrar();
                break;
            case 'Usuarios/Actualizar':
                $UserController->actualizar();
                break;
            case 'Usuarios/Eliminar':
                $UserController->eliminar();
                break;
            case 'Usuarios/Activar':
                $UserController->activar();
                break;
            case 'Usuarios/Inhabilitar':
                $UserController->inhabilitar();
                break;
            case 'Usuarios/ActualizarDatos':
                $UserController->actualizarDatos();
                break;
            //Clientes
            case 'Clientes':
                $clientesController->index();
                break;
            case 'Clientes/ObtenerCliente':
                $clientesController->obtenerCliente();
                break;
            case 'Clientes/Listar':
                $clientesController->listar();
                break;
            case 'Clientes/ListarEstados':
                $clientesController->listarEstados();
                break;
            case 'Clientes/Registrar':
                $clientesController->registrar();
                break;
            case 'Clientes/Actualizar':
                $clientesController->actualizar();
                break;
            case 'Clientes/Eliminar':
                $clientesController->eliminar();
                break;
            case 'Clientes/AsignarContactoPrincipal':
                $clientesController->asignarContactoPrincipal();
                break;
            case 'Clientes/ActualizarDatos':
                $clientesController->actualizarDatos();
                break;
            //Perfil
            case 'Perfil':
                $perfilController->index();
                break;
            //Contactos
            case 'Contactos/Listar':
                $contactosController->listar();
                break;
            case 'Contactos/ObtenerContacto':
                $contactosController->obtenerContacto();
                break;
            case 'Contactos/Registrar':
                $contactosController->registrar();
                break;
            case 'Contactos/Actualizar':
                $contactosController->actualizar();
                break;
            case 'Contactos/Eliminar':
                $contactosController->eliminar();
                break;
            //Roles
            case 'Rol/Listar':
                $rolController->listar();
                break;
            //Gestion de Proyectos
            case 'GestorProyectos':
                $GestorProyectosController->index();
                break;
            case 'GestorTareas':
                $GestorTareasController->index();
                break;
            case 'ColabGes':
                $GestorColabController->index();
                break;
            case 'GestorTareas/Listar':
                $GestorTareasController->listar();
                break;
            case 'GestorTareas/MisTareas':
                $GestorTareasController->misTareas();
                break;
            case 'GestorTareas/Asignar':
                $GestorTareasController->asignar();
                break;
            case 'GestorTareas/Completar':
                $GestorTareasController->completar();
                break;
            case 'GestorTareas/AdminList':
                $GestorTareasController->adminList();
                break;
            case 'GestorTareas/Crear':
                $GestorTareasController->crear();
                break;
            case 'GestorTareas/Eliminar':
                $GestorTareasController->eliminar();
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
            case 'Panel/GestorProyectos':
                $pruebaControles->index();
                break;
            default:
                echo "404 - Página no encontrada";
        }
    }
}