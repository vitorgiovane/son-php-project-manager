<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
  public function show($container, $params)
  {
    $user = new User($container);
    $userData = $user->get($params[1]);

    return "My name is $userData->name";
  }
}
