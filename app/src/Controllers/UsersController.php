<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
  public function index($container, $request)
  {
    return "Index";
  }

  public function show($container, $request)
  {
    $user = new User($container);
    $user->create(["name" => "Vitor"]);
    return $user->get($request->attributes->get(1));
  }

  public function store($container, $request)
  {
    return "Store";
  }

  public function update($container, $request)
  {
    return "Update";
  }

  public function destroy($container, $request)
  {
    return "Destroy";
  }
}
