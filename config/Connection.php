<?php

class Connection
{
  private $host;
  private $port;
  private $database;
  private $user;
  private $password;
  private $options;

  public function __construct($prefix, $host, $port, $database, $user, $password, $options)
  {
    $this->prefix = $prefix;
    $this->host = $host;
    $this->port = $port;
    $this->database = $database;
    $this->user = $user;
    $this->password = $password;
    $this->options = $options;
  }

  public function connect()
  {
    try {
      $dataSourceName = "$this->prefix:host=$this->host;port=$this->port;dbname=$this->database;";
      $connection = new \PDO($dataSourceName, $this->user, $this->password, $this->options);
      $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $connection;
    } catch (\PDOException $exception) {
      echo "<strong>Exception code:</strong> {$exception->getCode()}<br>";
      echo "<strong>Message:</strong> {$exception->getMessage()}";
      exit;
    }
  }
}
