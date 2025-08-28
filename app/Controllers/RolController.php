<?php
require_once __DIR__ . "/../Models/Rol.php";

class RolController
{
    private $rol;

    public function __construct($pdo)
    {
        $this->rol = new Rol($pdo);
    }

    public function listar()
    {
        echo json_encode($this->rol->getAll());
    }
}
