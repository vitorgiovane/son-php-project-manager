<?php

namespace Framework\Modules;

use Framework\App;
use Framework\Modules\Contract;

class ModuleRegistry
{
  private $app;
  private $composer;
  private $modules = [];

  public function setApp(App $app)
  {
    $this->app = $app;
  }

  public function setCompser($composer)
  {
    $this->composer = $composer;
  }

  public function add(Contract $module)
  {
    $this->modules[] = $module;
  }

  public function run()
  {
    foreach ($this->modules as $module) {
      // 
    }
  }
}
