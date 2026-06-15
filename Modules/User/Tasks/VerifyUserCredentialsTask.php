<?php

namespace User\Tasks;

use Illuminate\Support\Facades\Hash;
use Shared\Support\Task;
use User\Data\Models\User;
use User\Exceptions\WrongCredentialsException;

class VerifyUserCredentialsTask extends Task
{
    /**
     * @throws WrongCredentialsException
     */
    public function run(string $password, ?User $user = null): void
    {
        if ($user && Hash::check($password, $user->password)) {
            return;
        }

        throw new WrongCredentialsException();
    }
}
