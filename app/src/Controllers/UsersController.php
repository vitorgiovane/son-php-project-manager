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
    return $user->get($request->attributes->get(1));
  }

  public function store($container, $request)
  {
    $user = new User($container);
    return $user->create($request->request->all());
  }

  public function update($container, $request)
  {
    $user = new User($container);
    return $user->update($request->attributes->get(1), $request->request->all());
  }

  public function destroy($container, $request)
  {
    $user = new User($container);
    return $user->delete($request->attributes->get(1));
  }
}
