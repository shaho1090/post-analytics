<?php

namespace Post\Tasks;

use Post\Data\Models\PostView;
use Shared\Support\Task;

class CalculatePostTrendTask extends Task
{
    public function run(int $postId): string
    {
        $currentWeek = PostView::query()
            ->where('post_id', $postId)
            ->whereBetween('view_date', [
                now()->subDays(6)->toDateString(),
                now()->toDateString(),
            ])
            ->count();

        $previousWeek = PostView::query()
            ->where('post_id', $postId)
            ->whereBetween('view_date', [
                now()->subDays(13)->toDateString(),
                now()->subDays(7)->toDateString(),
            ])
            ->count();

        return match (true) {
            $currentWeek > $previousWeek => 'upward',
            $currentWeek < $previousWeek => 'downward',
            default => 'stable',
        };
    }
}
