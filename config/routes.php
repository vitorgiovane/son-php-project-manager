<?php

$router->add("get", "/", function () use ($container) {
  $pdo = $container["db"];
  var_dump($pdo);
  return "In home.";
});

$router->add("get", "/projects/(\d+)", function ($param) {
  return "In project $param[1].";
});
