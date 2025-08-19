<?php
$host = "localhost";
$dbname = "gestion_proyectos";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Error en la conexión: " . $e->getMessage());
}

define("BASE_URL", "/Sistema_de_Gestion_de_Proyectos_PHP");
