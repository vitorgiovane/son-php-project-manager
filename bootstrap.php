<?php

require __DIR__ . "/vendor/autoload.php";

$router = new Framework\Router;

$router->add("/", function () {
  return "In home.";
});

$router->add("/projects/(\d+)", function ($param) {
  return "In project $param[1].";
});

echo $router->run();
