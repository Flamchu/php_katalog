<?php

class Router
{
    private $routes = [];

    public function addRoute($route, $handler)
    {
        $this->routes[$route] = $handler;
    }

    public function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestUri = rtrim($requestUri, '/');

        $basePath = '/katalog';
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }

        if (array_key_exists($requestUri, $this->routes)) {
            $handler = $this->routes[$requestUri];
            call_user_func($handler);
            return;
        }

        foreach ($this->routes as $route => $handler) {

            $pattern = preg_replace('/\{[a-z]+\}/', '([^/]+)', $route);
            $pattern = "@^" . $pattern . "$@D";

            if (preg_match($pattern, $requestUri, $matches)) {

                preg_match_all('/\{([a-z]+)\}/', $route, $paramNames);
                $params = [];
                for ($i = 0; $i < count($paramNames[1]); $i++) {
                    $params[$paramNames[1][$i]] = $matches[$i + 1];
                }

                call_user_func($handler, $params);
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "404 - Page Not Found";
    }
}