<?php

namespace User\Actions;

use Shared\Support\Action;
use User\Events\UserRegistered;
use User\Tasks\CreateUserTask;

class RegisterUserAction extends Action
{
    public function run(array $data): void
    {
        $user = CreateUserTask::new()->run($data);
        UserRegistered::dispatch($user->email, $user->name);
    }
}
