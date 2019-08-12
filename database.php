<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once __DIR__ . '/vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();
} else {
  echo "<h2>File <strong>/vendor/autoload.php</strong> not found!</h2>
  <p>Run the <strong>composer install</strong> command on a terminal.</p>";
  die;
}

$container = require __DIR__ . "/app/config/containers.php";
$container = new Pimple\Container($container);

$databaseName = getenv("DB_DATABASE");
$query = "DROP DATABASE IF EXISTS `{$databaseName}`";
if (!empty($argv[1]) and $argv[1] === "fresh") {
  $container["db"]->exec($query);
  echo "Database dropped!" . PHP_EOL;
}

$files = scandir(__DIR__ . "/database");

foreach ($files as $file) {
  if (!is_dir(__DIR__ . "/database/" . $file)) {
    $sql = file_get_contents(__DIR__ . "/database/" . $file);
    $container["db"]->exec($sql);
    echo $file . " is migrated." . PHP_EOL;
  }
}
