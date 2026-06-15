<?php

namespace User\Tasks;

use Shared\Support\Task;
use User\Data\Models\User;

class FindUserByEmailTask extends Task
{
    public function run(string $email): ?User
    {
        return User::findByEmail($email);
    }
}
