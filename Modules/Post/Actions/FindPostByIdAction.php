<?php

namespace Post\Actions;

use Post\Data\Models\Post;
use Post\Tasks\FindPostByIdTask;
use Post\Tasks\StorePostViewTask;
use Shared\Support\Action;

class FindPostByIdAction extends Action
{
    public function run(int $id): Post
    {
        $post = FindPostByIdTask::new()->run($id);
        //recommended to do it asynchronously
        StorePostViewTask::new()->run($post);

        return $post;
    }
}
