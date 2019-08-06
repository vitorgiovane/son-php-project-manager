<?php

use App\Models\User;

$router->add("get", "/", function () {
  return "In home.";
});

$router->add("get", "/users/(\d+)", function ($params) use ($container) {
  $user = new User($container);
  $userData = $user->get($params[1]);
  return "In project $userData->name";
});
