<?php

namespace Post\Tasks;

use Post\Data\Models\Post;
use Shared\Support\Task;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class FindPostByIdTask extends Task
{
    public function run(int $id): ?Post
    {
        $post = Post::query()->find($id);

        if (null === $post) {
            throw new NotFoundResourceException('post not found');
        }

        return $post;
    }
}
