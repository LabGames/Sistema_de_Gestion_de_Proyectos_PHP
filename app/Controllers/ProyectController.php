<?php
require_once __DIR__ . "/../Models/Proyectos/Estados.php";
require_once __DIR__ . "/../Models/Proyectos/Tipos.php";
require_once __DIR__ . "/../Models/Proyectos/Proyecto.php";
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Models/Clientes.php";

class ProyectController
{
    private $estados;
    private $tipos;
    private $usuarios;
    private $proyectos;
    private $clientes;

    public function __construct($pdo)
    {
        $this->estados = new Estados($pdo);
        $this->tipos   = new Tipos($pdo);
        $this->usuarios = new User($pdo);
        $this->proyectos = new Proyecto($pdo);
        $this->clientes = new Clientes($pdo);
    }

    public function index()
    {
        $this->proyectos->actualizarTodosLosProyectos();

        $view = __DIR__ . "/../Views/proyects/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function new_proyect()
    {
        $tipos_value = $this->tipos->getAll();
        $estados_value = $this->estados->getAll();
        $clientes_value = $this->clientes->getAll();
        
        include __DIR__ . "/../Views/new_proyect.php";
    }

    public function listarEstados()
    {
        $estados_value = $this->estados->getAll();
        header('Content-Type: application/json');
        echo json_encode($estados_value);
    }

    public function listarTipos()
    {
        $tipos_value = $this->tipos->getAll();
        header('Content-Type: application/json');
        echo json_encode($tipos_value);
    }

    public function getUsuarioById($id)
    {
        $usuario_value = $this->usuarios->getByRol($id);
        header('Content-Type: application/json');
        echo json_encode($usuario_value);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $fecha_inicio = $_POST['start_date'];
            $fecha_fin = $_POST['end_date'];
            $tiempo_est = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / 3600;

            $archivo = null;
            if (isset($_FILES['project_files']) && $_FILES['project_files']['error'][0] == 0) {
                $archivo = file_get_contents($_FILES['project_files']['tmp_name'][0]);
            }

            $data = [
                'nombre' => $_POST['project_name'],
                'cliente_id' => $_POST['collab-asso'],
                'tipo_id' => $_POST['project_type'],
                'estado_id' => $_POST['state'],
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'tiempo_estimado_horas' => $tiempo_est,
                'jefe_proyecto_id' => $_SESSION['user_id'],
                'pronostico' => $_POST['forecast_comment'],
                'ingresos' => $_POST['estimated_income'],
                'archivo' => $archivo
            ];

            $save = $this->proyectos->create($data);

            if ($save) {
                $this->proyectos->actualizarTiempoReal($save);

                echo "<script>alert('Proyecto registrado correctamente'); window.location.href='".BASE_URL."/Home/Proyectos';</script>";
            } else {
                echo "<script>alert('Error al registrar proyecto'); window.history.back();</script>";
            }
        }
    }
}
