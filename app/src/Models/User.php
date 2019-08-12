<?php

namespace App\Models;

use App\Models\Model;

class User extends Model
{
  public function all()
  {
    $query = "SELECT * FROM users;";
    $statement = $this->db->prepare($query);
    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_OBJ);
  }

  public function get(array $conditions)
  {
    $query = $this->queryBuilder
      ->select("users")
      ->where($conditions)
      ->getData();
    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    return $statement->fetch(\PDO::FETCH_OBJ);
  }

  public function create(array $data)
  {
    $this->events->trigger("creating.user", null, $data);

    $queryBuilder = new \Framework\QueryBuilder;
    $query = $queryBuilder
      ->insert("users", $data)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    $lastInsertedId = $this->db->lastInsertId();
    $conditions = ["id" => $lastInsertedId];
    $user = $this->get($conditions);

    $this->events->trigger("created.user", null, $user);

    return $user;
  }

  public function update(array $conditions, array $data)
  {
    $this->events->trigger("updating.user", null, $data);

    $query = $this->queryBuilder
      ->update("users", $data)
      ->where($conditions)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);

    $updatedUser = $this->get($conditions);

    $this->events->trigger("updated.user", null, $updatedUser);
    return $updatedUser;
  }

  public function delete(array $conditions)
  {
    $user = $this->get($conditions);
    $this->events->trigger("deleting.user", null, $user);

    $query = $this->queryBuilder
      ->delete("users")
      ->where($conditions)
      ->getData();

    $statement = $this->db->prepare($query->sql);
    $statement->execute($query->bind);
    $this->events->trigger("deleted.user", null, $user);
    return $user;
  }
}
