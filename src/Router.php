<?php

namespace Framework;

class Router
{
  private $routes = [];

  public function add(string $route, $callback)
  {
    $route = "/^" . str_replace("/", "\/", $route) . "$/";
    $this->routes[$route] = $callback;
  }

  public function run()
  {
    $url = $_SERVER["PATH_INFO"] ?? "/";

    foreach ($this->routes as $route => $action) {
      if (preg_match($route, $url, $params)) {
        return $action($params);
      }
    }
    return "Page not found!";
  }
}
