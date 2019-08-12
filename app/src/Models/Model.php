<?php

namespace App\Models;

use Pimple\Container;

class Model
{
  protected $db;

  public function __construct(Container $container)
  {
    $this->db = $container["db"];
    $this->events = $container["events"];
  }
}
