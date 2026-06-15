<?php

namespace User\Tasks;

use Shared\Support\Task;
use User\Data\Models\User;

class CreateUserLoginTokenTask extends Task
{
    public function run(User $user): string
    {
        return $user->createToken('login')->plainTextToken;
    }
}
