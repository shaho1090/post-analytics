<?php

namespace User\Tasks;

use Shared\Support\Task;
use User\Data\Models\User;

class CreateUserTask extends Task
{
    public function run(array $data)
    {
        return User::query()->create($data);
    }
}
