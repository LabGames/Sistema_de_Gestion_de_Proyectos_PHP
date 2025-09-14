<?php
require_once __DIR__ . "/../Models/Contactos.php";
require_once __DIR__ . "/../Models/Clientes.php";

class ContactosController
{
    private $contactos;
    private $clientes;

    public function __construct($pdo)
    {
        $this->contactos = new Contactos($pdo);
        $this->clientes = new Clientes($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/contactos/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function listar()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode([
                "success" => false,
                "message" => "ID de cliente no proporcionado"
            ]);
            return;
        }

        $contactos = $this->contactos->getByClienteId($id);
        echo json_encode($contactos);
    }

    public function obtenerContacto()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(["success" => false, "message" => "ID no recibido"]);
            return;
        }

        $contactos = $this->contactos->findById($id);

        if ($contactos) {
            echo json_encode($contactos);
        } else {
            echo json_encode(["success" => false, "message" => "Contacto no encontrado"]);
        }
    }

    public function registrar()
    {
        $id = $_SESSION["cliente_id"];
        $nombre = $_POST['nombre'] ?? null;
        $correo = $_POST['correo'] ?? null;
        $telefono = $_POST['telefono'] ?? null;

        $errores = [];

        if (empty($nombre)) {
            $errores[] = "El nombre del contacto es obligatorio";
        }
        if (empty($correo)) {
            $errores[] = "El correo del contacto es obligatorio";
        }
        if (empty($telefono)) {
            $errores[] = "El telefono del contacto es obligatorio";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $resultado = $this->contactos->create($id, $nombre, $correo, $telefono);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Contacto registrado"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => ["Error al registrar contacto"]
            ]);
        }
    }

    public function actualizar()
    {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $correo = $_POST['correo'] ?? null;
        $telefono = $_POST['telefono'] ?? null;

        $errores = [];
        if (empty($id)) {
            $errores[] = "No se encontro el ID del contacto";
        }
        if (empty($nombre)) {
            $errores[] = "El nombre del contacto es obligatorio";
        }
        if (empty($correo)) {
            $errores[] = "El correo del contacto es obligatorio";
        }
        if (empty($telefono)) {
            $errores[] = "El telefono del contacto es obligatorio";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $resultado = $this->contactos->update($id, $nombre, $correo, $telefono);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Contacto actualizado"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => ["Error al actualizar contacto"]
            ]);
        }
    }

    public function eliminar()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode([
                "success" => false,
                "message" => "ID no recibido"
            ]);
            return;
        }

        $verificarContactoPrincipal = $this->clientes->verificarContactoPrincipal($id);

        if ($verificarContactoPrincipal) {
            echo json_encode([
                "success" => false,
                "message" => "No puedes eliminar tu contacto principal"
            ]);
            return;
        }

        $resultado = $this->contactos->delete($id);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Cliente eliminado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No se pudo eliminar el usuario"
            ]);
        }
    }
}
