<?php

namespace Framework;

class QueryBuilder
{
  private $sql;
  private $bind = [];

  public function select(string $table)
  {
    $this->sql = "SELECT * FROM `{$table}`";
    return $this;
  }

  public function insert(string $table, array $data)
  {
    $sql = "INSERT INTO `{$table}` (`%s`) VALUES (%s)";

    $columns = array_keys($data);
    $values = array_fill(0, count($columns), "?");
    $this->bind = array_values($data);

    $this->sql = sprintf($sql, implode(",", $columns), implode(",", $values));

    return $this;
  }

  public function update(string $table, array $data)
  {
    $this->sql = "UPDATE `{$table}` SET %s";
    $columns = array_keys($data);
    foreach ($columns as &$column) {
      $column = $column . " = ?";
    }
    $this->bind = array_values($data);
    $this->sql = sprintf($this->sql, implode(",", $columns));

    return $this;
  }

  public function delete(string $table)
  {
    $this->sql = "DELETE FROM `{$table}`";
    return $this;
  }

  public function where(array $conditions)
  { }

  public function getData(): \stdClass
  {
    $query = new \stdClass;
    $query->sql = $this->sql;
    $query->bind = $this->bind;

    $this->sql = null;
    $this->bind = [];

    return $query;
  }
}
