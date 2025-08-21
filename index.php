<?php
require_once __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/Router.php";

$url = $_GET['url'] ?? '';

$router = new Router($pdo);
$router->dispatch($url);
