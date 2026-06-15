<?php

namespace Post\Tasks;

use Post\Data\Models\Post;
use Shared\Support\Task;

class CreatePostTask extends Task
{
    public function run(array $data)
    {
        return Post::query()->create($data);
    }
}
