<?php

namespace Framework;

use Framework\Response;
use Pimple\Container;
use Framework\Router;
use Framework\Exceptions\HttpException;
use Framework\Modules\ModuleRegistry;

class App
{
  private $composer;
  private $container;
  private $middlewares = [
    "before" => [],
    "after" => []
  ];

  public function __construct($composer, array $modules, Container $container = null)
  {
    $this->container = $container;
    $this->composer = $composer;

    if ($this->container === null) {
      $this->container = new Container();
    }

    $this->loadRegistry($modules);
  }

  public function addMiddleware($on, $callback)
  {
    $this->middlewares[$on][] = $callback;
  }

  public function getContainer()
  {
    return $this->container;
  }

  public function getRouter()
  {
    if (!$this->container->offsetExists("router")) {
      $this->container["router"] = function () {
        return new Router;
      };
    }

    return $this->container["router"];
  }

  public function getResponse()
  {
    if (!$this->container->offsetExists("response")) {
      $this->container["response"] = function () {
        return new Response;
      };
    }

    return $this->container["response"];
  }

  public function getHttpErrorHandler()
  {
    if (!$this->container->offsetExists("httpErrorHandler")) {
      $this->container["httpErrorHandler"] = function ($container) {
        header("Content-Type: application/json");
        $response = json_encode([
          "code" => $container["exception"]->getCode(),
          "error" => $container["exception"]->getMessage()
        ]);

        return $response;
      };
    }

    return $this->container["httpErrorHandler"];
  }

  public function run()
  {
    try {
      $routeResponse = $this->getRouter()->run();
      $routeParams = $routeResponse["params"];
      $routeAction = $routeResponse["action"];

      $response = $this->getResponse();
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
      $this->container["exception"] = $exception;
      echo $this->getHttpErrorHandler();
    }
  }

  private function loadRegistry($modules)
  {
    $registry = new ModuleRegistry;
    $registry->setApp($this);
    $registry->setComposer($this->composer);

    foreach ($modules as $file => $module) {
      require $file;
      $registry->add(new $module);
    }

    $registry->run();
  }
}
