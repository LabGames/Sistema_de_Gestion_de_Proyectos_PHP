<?php
require_once __DIR__ . "/../Models/User.php";

class GestorTareasController
{
   
    public function index()
    {
        $view = __DIR__ . "/../Views/gestor_tareas/colaborador_gestor.php";
        include __DIR__ . "/../Views/home/index.php";
    }
    

}
