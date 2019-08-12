<?php

$after = [];

$app->addMiddleware("before", function ($container) {
  session_start();
});
$app->addMiddleware("before", function ($container) {
  header("Content-Type: application/json");
});
