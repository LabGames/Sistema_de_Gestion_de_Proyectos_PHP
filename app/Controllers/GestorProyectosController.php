<?php
require_once __DIR__ . "/../Models/User.php";

class GestorProyectosController
{
   
    public function index()
    {
        $view = __DIR__ . "/../Views/gestor_proyector.php";
        include __DIR__ . "/../Views/home/index.php";
    }
    

}
