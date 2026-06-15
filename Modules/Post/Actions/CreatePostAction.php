<?php

namespace Post\Actions;

use Post\Tasks\CreatePostTask;
use Post\Tasks\StorePostImageTask;
use Shared\Support\Action;

class CreatePostAction extends Action
{
    public function run(array $data)
    {
        $imagePath = StorePostImageTask::new()->run($data['image'] ?? null);

        return CreatePostTask::new()->run([
            'image' => $imagePath,
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth('sanctum')->id(),
        ]);
    }
}
