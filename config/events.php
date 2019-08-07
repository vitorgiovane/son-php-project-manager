<?php

$container["events"]->attach("created.users", new App\Events\UserCreated);
