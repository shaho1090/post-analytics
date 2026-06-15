<?php

namespace User\Actions;

use Shared\Support\Action;
use User\Tasks\CreateUserTask;

class RegisterUserAction extends Action
{
    public function run(array $data)
    {
        CreateUserTask::new()->run($data);
    }
}
