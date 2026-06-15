<?php

namespace User\Actions;

use Shared\Support\Action;
use User\Exceptions\WrongCredentialsException;
use User\Tasks\CreateUserLoginTokenTask;
use User\Tasks\FindUserByEmailTask;
use User\Tasks\VerifyUserCredentialsTask;

class LoginUserAction extends Action
{
    /**
     * @throws WrongCredentialsException
     */
    public function run(array $data): string
    {
        $user = FindUserByEmailTask::new()->run($data['email']);

        VerifyUserCredentialsTask::new()->run($data['password'], $user);

        return CreateUserLoginTokenTask::new()->run($user);
    }
}
