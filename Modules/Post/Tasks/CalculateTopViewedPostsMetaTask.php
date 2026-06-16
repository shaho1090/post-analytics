<?php

namespace Post\Tasks;

use Illuminate\Support\Collection;
use Shared\Support\Task;

class CalculateTopViewedPostsMetaTask extends Task
{
    public function run(Collection $posts): array
    {
        return [
            'total_posts_analyzed' => $posts->count(),

            'period_days' => 7,

            'average_views_per_post' => round(
                $posts->avg('total_views') ?? 0
            ),
        ];
    }
}
