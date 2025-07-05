<?php
class Router
{
    private $get = [];
    private $post = [];
    private $put = [];
    private $delete = [];

    public function get($path, $handler)
    {
        $this->get[$path] = $handler;
    }

    public function post($path, $handler)
    {
        $this->post[$path] = $handler;
    }

    public function put($path, $handler){
        $this->put[$path] = $handler;
    }

    public function dispatch($path, $method)
    {
        $routes = [];
        switch ($method) {
            case "GET":
                $routes = $this->get;
                break;
            case "POST":
                $routes = $this->post;
                break;
            case "PUT":
                $routes = $this->put;
                break;
            case "DELETE":
                $routes = $this->delete;
                break;
            default:
                echo "Requisição não suportada!";
                return;
        }
        foreach ($routes as $route => $handler) {
            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
            if (preg_match("#^$pattern$#", $path, $matches)) {
                if (count($matches) > 1) { //Com certeza dá pra melhorar
                    $handler($matches[1]);
                }else{
                    $handler();
                }
                return;
            }
        }
        echo "Página não encontrada!!";
    }
}
