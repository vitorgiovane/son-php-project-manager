<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
  public function index($container, $request)
  {
    $user = new User($container);
    return $user->all();
  }

  public function show($container, $request)
  {
    $user = new User($container);
    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];
    return $user->get($conditions);
  }

  public function store($container, $request)
  {
    $user = new User($container);
    return $user->create($request->request->all());
  }

  public function update($container, $request)
  {
    $user = new User($container);

    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];

    return $user->update($conditions, $request->request->all());
  }

  public function destroy($container, $request)
  {
    $user = new User($container);

    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];

    return $user->delete($conditions);
  }
}
