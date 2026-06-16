<?php

namespace Post\Tasks;

use Illuminate\Support\Collection;
use Post\Data\Models\PostView;
use Shared\Support\Task;

class GetDailyPostAnalyticsTask extends Task
{
    public function run(
        int $postId,
        string $from,
        string $to,
    ): Collection {
        return PostView::query()
            ->selectRaw("
                view_date as date,

                COUNT(*) as total_views,

                COUNT(DISTINCT user_id)
                    as registered_users,

                COUNT(
                    DISTINCT CASE
                        WHEN user_id IS NULL
                        THEN ip_address::text
                    END
                ) as guest_users
            ")
            ->where('post_id', $postId)
            ->whereBetween('view_date', [$from, $to])
            ->groupBy('view_date')
            ->orderBy('view_date')
            ->get()
            ->map(function ($row) {
                $row->unique_users =
                    (int) $row->registered_users +
                    (int) $row->guest_users;

                $row->total_views = (int) $row->total_views;
                $row->registered_users = (int) $row->registered_users;
                $row->guest_users = (int) $row->guest_users;

                return $row;
            });
    }
}
