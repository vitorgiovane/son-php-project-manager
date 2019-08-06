<?php

use Pimple\Container;

require __DIR__ . "/database.php";

$container = new Container();

$container["db"] = $db->connect();
