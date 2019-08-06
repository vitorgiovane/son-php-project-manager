<?php

namespace Framework;

class Router
{
  private $routes = [];

  public function add(string $route, $callback)
  {
    $this->routes[$route] = $callback;
  }

  public function run()
  {
    $route = $_SERVER["PATH_INFO"] ?? "/";

    if (array_key_exists($route, $this->routes)) {
      return $this->routes[$route]();
    }
    return "Page not found!";
  }
}
