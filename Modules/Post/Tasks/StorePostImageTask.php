<?php

namespace Post\Tasks;

use Illuminate\Http\UploadedFile;
use Shared\Support\Task;

class StorePostImageTask extends Task
{
    public function run(?UploadedFile $file): ?string
    {
        if (!$file) {
            return null;
        }

        return $file->store('posts', 'public');
    }
}
