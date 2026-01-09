<?php

spl_autoload_register(function ($class) {
    $pastas = ['controller', 'dao', 'model'];

    foreach ($pastas as $pasta) {
        $caminho = __DIR__ . "/$pasta" . "/$class.php";
        if (file_exists($caminho)) {
            require_once $caminho;
            return;
        }
    }
});

/*$path_replace = str_replace('/', '/', $_SERVER["REQUEST_URI"]);
$path = parse_url($path_replace, PHP_URL_PATH);*/
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$method;

if (isset($_POST["method"])) {
    $method = $_POST["method"];
} else {
    $method = $_SERVER["REQUEST_METHOD"];
}

require_once 'router.php';
$router = new Router();

foreach(glob(__DIR__ . '/routes/*.php') as $arquivo){
    $registrarRota = require $arquivo;
    $registrarRota($router);
}

$router->get('/', function () {
    require 'view/home.php';
});

$router->dispatch($path, $method);
