<?php
require_once __DIR__ . "/../Models/Contactos.php";

class ContactosController
{
    private $contactos;

    public function __construct($pdo)
    {

        $this->contactos = new Contactos($pdo);
    }


    public function listar()
    {
        $contactos = $this->contactos->getAll();
        echo json_encode($contactos);
    }

}
