<?php

namespace User\Tasks;

use Illuminate\Contracts\Auth\Authenticatable;
use Shared\Support\Task;

class GetAuthenticatedUserTask extends Task
{
    public function run(string $guard='sanctum'): ?Authenticatable
    {
        return auth($guard)->user();
    }
}
