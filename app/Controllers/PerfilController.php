<?php

class PerfilController
{

    public function index()
    {
        if ($_SESSION["estado_cliente"] == true) {
            $view = __DIR__ . "/../Views/perfil/cliente.php";
        } else {
            $view = __DIR__ . "/../Views/perfil/usuario.php";
        }
        include __DIR__ . "/../Views/home/index.php";
    }


}
