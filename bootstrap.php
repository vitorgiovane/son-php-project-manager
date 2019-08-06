<?php

require __DIR__ . "/vendor/autoload.php";

$router = new Framework\Router;

$router->add("/", function () {
  return "In home.";
});

$router->add("/projects", function () {
  return "In projects.";
});

echo $router->run();
