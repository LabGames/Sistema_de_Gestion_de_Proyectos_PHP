<?php
require_once __DIR__ . "/../Models/Contactos.php";

class ContactosController
{
    private $contactos;

    public function __construct($pdo)
    {

        $this->contactos = new Contactos($pdo);
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
}
