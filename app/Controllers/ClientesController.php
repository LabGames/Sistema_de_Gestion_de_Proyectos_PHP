<?php
require_once __DIR__ . "/../Models/Clientes.php";

class ClientesController
{

    private $clientes;

    public function __construct($pdo)
    {
        $this->clientes = new Clientes($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/clientes/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function listar()
    {
        $clientes = $this->clientes->getAll();
        echo json_encode($clientes);
    }

    public function listarEstados(){
        $estados = $this->clientes->getAll();
        echo json_decode($estados);
    }

}
