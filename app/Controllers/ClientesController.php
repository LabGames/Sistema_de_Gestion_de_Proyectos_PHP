<?php
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Models/Clientes.php";
require_once __DIR__ . "/../Models/Contactos.php";
require_once __DIR__ . "/../Models/EstadosCliente.php";

class ClientesController
{
    private $user;
    private $clientes;
    private $estados_clientes;
    private $contactos;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
        $this->clientes = new Clientes($pdo);
        $this->estados_clientes = new EstadosCliente($pdo);
        $this->contactos = new Contactos($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/clientes/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function obtenerCliente()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(["success" => false, "message" => "ID no recibido"]);
            return;
        }

        $cliente = $this->clientes->findById($id);

        if ($cliente) {
            echo json_encode($cliente);
        } else {
            echo json_encode(["success" => false, "message" => "Cliente no encontrado"]);
        }
    }

    public function listar()
    {
        $clientes = $this->clientes->getAll();
        echo json_encode($clientes);
    }

    public function listarEstados()
    {
        $estados = $this->estados_clientes->getAll();
        echo json_encode($estados);
    }

    public function registrar()
    {
        $nombreCliente     = $_POST['nombreCliente'] ?? null;
        $empresa      = $_POST['empresa'] ?? null;
        $rubro    = $_POST['rubro'] ?? null;
        $estado    = $_POST['estado'] ?? null;

        $nombreContacto      = $_POST['nombreContacto'] ?? null;
        $correoContacto    = $_POST['correoContacto'] ?? null;
        $telefonoContacto    = $_POST['telefonoContacto'] ?? null;

        $correoUsuario    = $_POST['correoUsuario'] ?? null;
        $password    = $_POST['password'] ?? null;


        $errores = [];

        if (empty($nombreCliente)) {
            $errores[] = "El nombre del cliente es obligatorio";
        }
        if (empty($empresa)) {
            $errores[] = "El nombre de la empresa es obligatorio";
        }
        if (empty($rubro)) {
            $errores[] = "El rubro de la empresa es obligatorio";
        }
        if (empty($estado)) {
            $errores[] = "El estado del cliente es obligatorio";
        }
        if (empty($nombreContacto)) {
            $errores[] = "El nombre del contacto es obligatorio";
        }
        if (empty($correoContacto)) {
            $errores[] = "El correo del contacto es obligatorio";
        }
        if (empty($telefonoContacto)) {
            $errores[] = "El telefono del contacto es obligatorio";
        }
        if (empty($correoUsuario)) {
            $errores[] = "El correo del usuario es obligatorio";
        }
        if (empty($password)) {
            $errores[] = "La contraseña es obligatoria";
        }

        $userVerify = $this->user->findByEmail($correoUsuario);
        if ($userVerify) {
            $errores[] = "Este correo ya esta registrado";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $idUsuario = $this->user->create($nombreCliente, 2, $correoUsuario, $hashedPassword, 1);
        $idCliente = $this->clientes->create($nombreCliente, $empresa, $rubro, null, $estado, $idUsuario);
        $idContacto = $this->contactos->create($idCliente, $nombreContacto, $correoContacto, $telefonoContacto);

        $resultadoFinal = $this->clientes->update($idCliente, $nombreCliente, $empresa, $rubro, $idContacto, $estado, $idUsuario);


        if ($idUsuario && $idCliente && $idContacto && $resultadoFinal) {
            echo json_encode([
                "success" => true,
                "message" => "Cliente registrado"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => ["Error al registrar cliente"]
            ]);
        }
    }

    public function actualizar()
    {
        $id = $_POST['id'] ?? null;
        $nombreCliente     = $_POST['nombreCliente'] ?? null;
        $empresa      = $_POST['empresa'] ?? null;
        $rubro    = $_POST['rubro'] ?? null;
        $estado    = $_POST['estado'] ?? null;
        $contacto    = $_POST['contacto'] ?? null;
        $user_id    = $_POST['user_id'] ?? null;




        $errores = [];
        if (empty($id)) {
            $errores[] = "No se encontro el ID del cliente";
        }
        if (empty($nombreCliente)) {
            $errores[] = "El nombre del cliente es obligatorio";
        }
        if (empty($empresa)) {
            $errores[] = "El nombre de la empresa es obligatorio";
        }
        if (empty($rubro)) {
            $errores[] = "El rubro de la empresa es obligatorio";
        }
        if (empty($estado)) {
            $errores[] = "El estado del cliente es obligatorio";
        }
        if (empty($contacto)) {
            $errores[] = "El contacto principal es obligatorio";
        }
        if (empty($user_id)) {
            $errores[] = "No se encontro el usuario";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }



        $resultado = $this->clientes->update($id, $nombreCliente, $empresa, $rubro, $contacto, $estado, $user_id);


        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Cliente actualizado"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => ["Error al actualizar cliente"]
            ]);
        }
    }
}
