<?php

namespace Post\Tasks;

use Illuminate\Pagination\LengthAwarePaginator;
use Post\Data\Models\Post;
use Shared\Support\Task;

class GetAllPostsTask extends Task
{
    public function run(): LengthAwarePaginator
    {
        return Post::query()
            ->with([
                'author:id,name,email',
            ])
            ->withCount([
                'views',
                'views as unique_views_count' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT COALESCE(user_id::text, ip_address))');
                },
            ])
            ->latest()
            ->paginate(15);
    }
}
