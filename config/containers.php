<?php

use Pimple\Container;

require __DIR__ . "/database.php";

$container = new Container();

$container["events"] = function () {
  return new Zend\EventManager\EventManager;
};

$container["db"] = $db->connect();
