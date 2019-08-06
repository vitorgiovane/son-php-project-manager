<?php

namespace Framework;

class Response
{
  public function __invoke($action, $params)
  {
    if (is_string($action)) {
      $action = explode("::", $action);
      $action[0] = new $action[0];
    }
    echo call_user_func_array($action, $params);
  }
}
