<?php

namespace Framework;

use Framework\QueryBuilder;
use Pimple\Container;

abstract class Model
{
  protected $db;
  protected $events;
  protected $queryBuilder;
  protected $table;

  public function __construct(Container $container)
  {
    $this->db = $container["db"];
    $this->events = $container["events"];
    $this->queryBuilder = new QueryBuilder;

    if (empty($this->table)) {
      $table = explode("\\", \get_called_class());
      $table = array_pop($table);
      $this->table = \strtolower($table) . "s";
    }
  }

  public function all(array $conditions = [])
  {
    $query = $this->queryBuilder
      ->select($this->table)
      ->where($conditions)
      ->getData();
    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    return $statement->fetchAll(\PDO::FETCH_OBJ);
  }

  public function get(array $conditions)
  {
    $query = $this->queryBuilder
      ->select($this->table)
      ->where($conditions)
      ->getData();
    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    return $statement->fetch(\PDO::FETCH_OBJ);
  }

  public function create(array $data)
  {
    $this->events->trigger("creating.{$this->table}", null, $data);

    $queryBuilder = new \Framework\QueryBuilder;
    $query = $queryBuilder
      ->insert($this->table, $data)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    $lastInsertedId = $this->db->lastInsertId();
    $conditions = ["id" => $lastInsertedId];
    $user = $this->get($conditions);

    $this->events->trigger("created.{$this->table}", null, $user);

    return $user;
  }

  public function update(array $conditions, array $data)
  {
    $this->events->trigger("updating.{$this->table}", null, $data);

    $query = $this->queryBuilder
      ->update($this->table, $data)
      ->where($conditions)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    $updatedUser = $this->get($conditions);

    $this->events->trigger("updated.{$this->table}", null, $updatedUser);
    return $updatedUser;
  }

  public function delete(array $conditions)
  {
    $user = $this->get($conditions);
    $this->events->trigger("deleting.{$this->table}", null, $user);

    $query = $this->queryBuilder
      ->delete($this->table)
      ->where($conditions)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);
    $this->events->trigger("deleted.{$this->table}", null, $user);
    return $user;
  }
}
