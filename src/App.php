<?php

namespace Framework;

use Framework\Response;
use Framework\Exceptions\HttpException;

class App
{
  private $router;
  private $container;
  private $middlewares = [
    "before" => [],
    "after" => []
  ];

  public function __construct($container, $router)
  {
    $this->container = $container;
    $this->router = $router;
  }

  public function addMiddleware($on, $callback)
  {
    $this->middlewares[$on][] = $callback;
  }

  public function run()
  {
    try {
      $routeResponse = $this->router->run();
      $routeParams = $routeResponse["params"];
      $routeAction = $routeResponse["action"];

      $response = new Response;
      $params = [
        "container" => $this->container,
        "params" => $routeParams
      ];

      $middlewaresBeforeResponse = $this->middlewares["before"];
      foreach ($middlewaresBeforeResponse as $middleware) {
        $middleware($this->container);
      }

      $response($routeAction, $params);

      $middlewaresAfterResponse = $this->middlewares["after"];
      foreach ($middlewaresAfterResponse as $middleware) {
        $middleware($this->container);
      }
    } catch (HttpException $exception) {
      echo json_encode(["error" => $exception->getMessage()]);
    }
  }
}
