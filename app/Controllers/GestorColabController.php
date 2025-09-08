<?php
require_once __DIR__ . "/../Models/User.php";

class GestorColabController
{
   
    public function index()
    {
        $view = __DIR__ . "/../Views/colaboradores/colab_ges.php";
        include __DIR__ . "/../Views/home/index.php";
    }
    

}
