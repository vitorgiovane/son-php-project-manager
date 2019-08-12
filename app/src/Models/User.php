<?php

namespace App\Models;

use Pimple\Container;

class User
{
  private $db;

  public function __construct(Container $container)
  {
    $this->db = $container["db"];
    $this->events = $container["events"];
  }

  public function get($id)
  {
    $query = "SELECT * FROM users WHERE id = ?";
    $statement = $this->db->prepare($query);
    $statement->execute([$id]);

    return $statement->fetch(\PDO::FETCH_OBJ);
  }

  public function store(array $data)
  {
    $userData = array_values($data);
    $this->events->trigger("creating.users", null, $data);

    $sql = "INSERT INTO `users` (`name`) VALUES (?)";
    $statement = $this->db->prepare($sql);
    $statement->execute($userData);

    $lastInsertedId = $this->db->lastInsertId();
    $user = $this->get($lastInsertedId);

    $this->events->trigger("created.users", null, $user);

    return $user;
  }
}
