<?php

$after = [];

$app->addMiddleware("before", function ($container) {
  session_start();
});
$app->addMiddleware("before", function ($container) {
  header("Content-Type: text/plain");
});
$app->addMiddleware("before", function ($container) {
  echo json_encode(["message" => "before"]);
});
$app->addMiddleware("after", function ($container) {
  echo json_encode(["message" => "After"]);
});
$app->addMiddleware("after", function ($container) {
  echo json_encode(["message" => "After 2"]);
});
