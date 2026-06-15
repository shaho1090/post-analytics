<?php

namespace User\Tasks;

use User\Models\User;
use Shared\Support\Task;

class CreateUserTask extends Task
{
    public function run(array $data)
    {
        return User::query()->create($data);
    }
}
