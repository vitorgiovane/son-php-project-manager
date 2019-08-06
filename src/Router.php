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
    $url = $this->getCurrentUrl();

    foreach ($this->routes as $route => $action) {
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
