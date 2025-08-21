<?php
require_once __DIR__ . "/../Models/User.php";

class HomeController
{
   
    public function index()
    {
        include __DIR__ . "/../Views/home/index.php";
    }
}
