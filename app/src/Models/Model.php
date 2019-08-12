<?php

namespace App\Models;

use Framework\QueryBuilder;
use Pimple\Container;

class Model
{
  protected $db;
  protected $events;
  protected $queryBuilder;

  public function __construct(Container $container)
  {
    $this->db = $container["db"];
    $this->events = $container["events"];
    $this->queryBuilder = new QueryBuilder;
  }
}
