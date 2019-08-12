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

  public function get($id)
  {
    $query = "SELECT * FROM users WHERE id = ?;";
    $statement = $this->db->prepare($query);
    $statement->execute([$id]);

    return $statement->fetch(\PDO::FETCH_OBJ);
  }

  public function create(array $data)
  {
    $userData = array_values($data);
    $this->events->trigger("creating.user", null, $data);

    $sql = "INSERT INTO `users` (`name`) VALUES (?);";
    $statement = $this->db->prepare($sql);
    $statement->execute($userData);

    $lastInsertedId = $this->db->lastInsertId();
    $user = $this->get($lastInsertedId);

    $this->events->trigger("created.user", null, $user);

    return $user;
  }

  public function update($id, $data)
  {
    $this->events->trigger("updating.user", null, $data);
    $userData = array_values($data);
    $userData = array_merge($userData, [$id]);
    $query = "UPDATE users SET `name` = ? WHERE id = ?;";
    $statement = $this->db->prepare($query);
    $statement->execute($userData);

    $updatedUser = $this->get($id);

    $this->events->trigger("updated.user", null, $updatedUser);
    return $updatedUser;
  }

  public function delete($id)
  {
    $user = $this->get($id);
    $this->events->trigger("deleting.user", null, $user);
    $query = "DELETE FROM `users` WHERE `id` = ?;";
    $statement = $this->db->prepare($query);
    $statement->execute([$id]);
    $this->events->trigger("deleted.user", null, $user);
    return $user;
  }
}
