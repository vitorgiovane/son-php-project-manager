<?php

require __DIR__ . "/vendor/autoload.php";

$router = new Framework\Router;

$router->add("get", "/", function () {
  return "In home.";
});

$router->add("get", "/projects/(\d+)", function ($param) {
  return "In project $param[1].";
});

try {
  echo $router->run();
} catch (\Framework\Exceptions\HttpException $exception) {
  echo json_encode(["error" => $exception->getMessage()]);
}
