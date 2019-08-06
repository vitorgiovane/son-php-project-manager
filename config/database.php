<?php

require_once __DIR__ . "/Connection.php";

$prefix = getenv("DB_PREFIX");
$host = getenv("DB_HOST");
$port = getenv("DB_PORT");
$database = getenv("DB_DATABASE");
$user = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$options = [
  \PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8"
];

$db = new Connection(
  $prefix,
  $host,
  $port,
  $database,
  $user,
  $password,
  $options
);
