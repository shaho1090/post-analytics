<?php

namespace Post\Tasks;

use Illuminate\Support\Collection;
use Post\Data\Models\Post;
use Shared\Support\Task;

class GetTopViewedPostsTask extends Task
{
    public function run(int $limit = 10): Collection
    {
        return Post::query()
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('post_views', 'post_views.post_id', '=', 'posts.id')
            ->selectRaw("
                posts.id as post_id,
                posts.title,
                users.name as author,
                posts.created_at,

                COUNT(post_views.id) as total_views,

                COUNT(
                    DISTINCT COALESCE(
                        post_views.user_id::text,
                        post_views.ip_address::text
                    )
                ) as unique_users
            ")
            ->groupBy([
                'posts.id',
                'posts.title',
                'users.name',
                'posts.created_at',
            ])
            ->orderByDesc('total_views')
            ->limit($limit)
            ->get();
    }
}
