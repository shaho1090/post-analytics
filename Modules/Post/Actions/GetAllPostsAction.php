<?php

namespace Post\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Post\Tasks\GetAllPostsTask;
use Shared\Support\Action;

class GetAllPostsAction extends Action
{
    public function run(): LengthAwarePaginator
    {
        return GetAllPostsTask::new()->run();
    }
}
