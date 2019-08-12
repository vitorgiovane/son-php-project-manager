<?php

$container["events"] = function () {
  return new Zend\EventManager\EventManager;
};

require __DIR__ . "/database.php";
$container["db"] = $db->connect();

$container["user_model"] = function ($container) {
  return new \App\Models\User($container);
};
