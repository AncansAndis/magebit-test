<?php
namespace Framework;

class Router
{
    protected $routes;

    protected $default;

    /**
     * @param $route
     * @param $closure
     */
    public function get($route,$closure)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $this->routes[$route] = $closure;
        }
    }

    /**
     * @param $route
     * @param $closure
     */
    public function post($route,$closure)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->routes[$route] = $closure;
        }
    }

    /**
     * Used to render page if both GET and POST requests needed
     *
     * @param $route
     * @param $closure
     */
    public function render($route,$closure)
    {
        $this->routes[$route] = $closure;
    }

    /**
     * @param $closure
     */
    public function notFound($closure)
    {
        $this->default = $closure;
    }

    /**
     * @param $getParameter
     * @return false|mixed|void
     */
    public function dispatch($getParameter)
    {
        $getParameter = $_GET[$getParameter] ?? null;

        foreach ((array)$this->routes as $route => $closure)
        {
            if($getParameter == $route) {
                return call_user_func($closure);
            }
        }

        if(is_callable($this->default)) return call_user_func($this->default);
    }

}
