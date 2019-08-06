<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
  public function __construct($container)
  {
    $this->container = $container;
  }

  public function show($id)
  {
    $user = new User($this->container);
    $userData = $user->get($id);
    return "My name is $userData->name";
  }
}
