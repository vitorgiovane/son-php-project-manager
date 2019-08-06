<?php

namespace Framework;

class Response
{
  public function __invoke($action, $params)
  {
    echo $action($params);
  }
}
