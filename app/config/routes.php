<?php

$router->add("get", "/", function () {
  return "In home.";
});

$router->add("get", "/users", "\App\Controllers\UsersController::index");
$router->add("get", "/users/(\d+)", "\App\Controllers\UsersController::show");
$router->add("POST", "/users", "\App\Controllers\UsersController::store");
$router->add("PUT", "/users/(\d+)", "\App\Controllers\UsersController::update");
$router->add("DELETE", "/users/(\d+)", "\App\Controllers\UsersController::delete");
