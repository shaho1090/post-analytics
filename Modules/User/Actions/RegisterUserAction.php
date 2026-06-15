<?php

namespace User\Actions;

use Notification\Tasks\SendUserWelcomeEmailTask;
use Shared\Support\Action;
use User\Tasks\CreateUserTask;

class RegisterUserAction extends Action
{
    public function run(array $data)
    {
        $user = CreateUserTask::new()->run($data);
        SendUserWelcomeEmailTask::new()->run($user);
    }
}
