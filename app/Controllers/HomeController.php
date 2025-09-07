<?php
require_once __DIR__ . "/../Models/User.php";

class HomeController
{

    public function index()
    {
        if ($_SESSION["estado_cliente"] == true) {
            $view = __DIR__ . "/../Views/panel/cliente.php";
        } else if ($_SESSION["rol_id"] == 1) {
            $view = __DIR__ . "/../Views/panel/admin.php";
        } else {
            $view = __DIR__ . "/../Views/panel/user.php";
        }
        include __DIR__ . "/../Views/home/index.php";
    }
}
