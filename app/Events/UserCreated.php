<?php

namespace App\Events;

class UserCreated
{
  public function __invoke($event)
  {
    $eventName = $event->getName();
    $params = $event->getParams();

    $data = sprintf("Disparado event %s, com parametros: %s", $eventName, json_encode($params));
    echo $data;
  }
}
