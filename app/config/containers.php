<?php

$container["events"] = function () {
  return new Zend\EventManager\EventManager;
};

require __DIR__ . "/database.php";
$container["db"] = $db->connect();
