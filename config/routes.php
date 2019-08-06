<?php

$router->add("get", "/", function () {
  return "In home.";
});

$router->add("get", "/users/(\d+)", function ($params) use ($container) {
  return (new \App\Controllers\UsersController($container))->show($params[1]);
});
