<?php

namespace Post\Actions;

use Post\Data\Models\Post;
use Post\Tasks\FindPostByIdTask;
use Shared\Support\Action;

class FindPostByIdAction extends Action
{
    public function run(int $id): Post
    {
        $post = FindPostByIdTask::new()->run($id);

        return $post;
    }
}
