<?php

namespace User\Actions;

use Illuminate\Contracts\Auth\Authenticatable;
use Shared\Support\Action;
use User\Tasks\GetAuthenticatedUserTask;

class GetUserProfileAction extends Action
{
    public function run(): ?Authenticatable
    {
        return GetAuthenticatedUserTask::new()->run();
    }
}
