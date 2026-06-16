<?php

namespace Post\Tasks;

use Carbon\Carbon;
use Post\Data\Models\PostView;
use Shared\Support\Task;

class HasViewedPostTodayTask extends Task
{
    public function run(
        int $postId,
        ?int $userId,
        string $ipAddress,
        Carbon $date
    ): bool {
        return PostView::query()
            ->where('post_id', $postId)
            ->where('view_date', $date->toDateString())
            ->when(
                $userId,
                fn ($query) => $query->where('user_id', $userId),
                fn ($query) => $query->whereNull('user_id')
                    ->where('ip_address', $ipAddress)
            )
            ->exists();
    }
}
