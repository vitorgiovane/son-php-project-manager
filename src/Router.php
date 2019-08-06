<?php

namespace Framework;

class Router
{
  private $routes = [];

  public function add(string $method, string $route, $callback)
  {
    $method = strtolower($method);
    $route = "/^" . str_replace("/", "\/", $route) . "$/";
    $this->routes[$method][$route] = $callback;
  }

  public function run()
  {
    $url = $this->getCurrentUrl();
    $method = strtolower($_SERVER["REQUEST_METHOD"]);

    if (empty($this->routes[$method])) {
      return "Page not found!";
    }

    foreach ($this->routes[$method] as $route => $action) {
      if (preg_match($route, $url, $params)) {
        return $action($params);
      }
    }
    return "Page not found!";
  }

  public function getCurrentUrl()
  {
    $url = $_SERVER["PATH_INFO"] ?? "/";
    if (strlen($url) > 1) {
      $url = rtrim($url, "/");
    }
    return $url;
  }
}
