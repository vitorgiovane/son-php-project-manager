<?php

namespace App\Controllers;

use Framework\ResourcesController;

class UsersController extends ResourcesController
{
  protected function getModel(): string
  {
    return "user_model";
  }
}
