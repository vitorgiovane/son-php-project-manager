<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once __DIR__ . '/vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();
} else {
  echo "<h2>File <strong>/vendor/autoload.php</strong> not found!</h2>
  <p>Run the <strong>composer install</strong> command on a terminal.</p>";
  die;
}

require __DIR__ . "/vendor/autoload.php";

$router = new Framework\Router;

require __DIR__ . "/config/containers.php";
require __DIR__ . "/config/routes.php";

try {
  $result = $router->run();

  $response = new Framework\Response;
  $params = [
    "container" => $container,
    "params" => $result["params"]
  ];

  $response($result["action"], $params);
} catch (\Framework\Exceptions\HttpException $exception) {
  echo json_encode(["error" => $exception->getMessage()]);
}
