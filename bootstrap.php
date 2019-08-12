<?php

use Framework\App;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once __DIR__ . '/vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();
} else {
  echo "<h2>File <strong>/vendor/autoload.php</strong> not found!</h2>
  <p>Run the <strong>composer install</strong> command on a terminal.</p>";
  die;
}

$composer = require __DIR__ . "/vendor/autoload.php";

require __DIR__ . "/config/modules.php";

$app = new App($composer, $modules);

$app->run();
