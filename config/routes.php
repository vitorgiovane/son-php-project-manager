<?php

$router->add("get", "/", function () {
  return "In home.";
});

$router->add("get", "/users/(\d+)", "\App\Controllers\UsersController::show");
