<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
  public function show($container, $request)
  {
    $user = new User($container);
    $userData = $user->get($request->attributes->get(1));

    return "My name is $userData->name";
  }
}
