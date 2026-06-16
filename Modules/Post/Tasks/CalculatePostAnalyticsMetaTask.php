<?php

namespace Post\Tasks;

use Illuminate\Support\Collection;
use Shared\Support\Task;

class CalculatePostAnalyticsMetaTask extends Task
{
    public function run(Collection $analytics): array
    {
        $totalViews = $analytics->sum('total_views');

        $totalUniqueUsers = $analytics->sum('unique_users');

        $totalDays = $analytics->count();

        $averageDailyUsers = $totalDays > 0
            ? round($totalUniqueUsers / $totalDays, 1)
            : 0;

        $peakDay = $analytics
            ->sortByDesc('unique_users')
            ->first();

        return [
            'total_days' => $totalDays,

            'total_unique_users' => $totalUniqueUsers,

            'total_views' => $totalViews,

            'average_daily_users' => $averageDailyUsers,

            'peak_day' => $peakDay?->date,

            'peak_users' => $peakDay?->unique_users ?? 0,

            'trend' => $this->calculateTrend($analytics),

            'trend_percentage' => $this->calculateTrendPercentage($analytics),
        ];
    }

    private function calculateTrend(Collection $analytics): string
    {
        if ($analytics->count() < 2) {
            return 'stable';
        }

        $first = (int) $analytics->first()->unique_users;
        $last = (int) $analytics->last()->unique_users;

        if ($last > $first) {
            return 'upward';
        }

        if ($last < $first) {
            return 'downward';
        }

        return 'stable';
    }

    private function calculateTrendPercentage(
        Collection $analytics
    ): float {
        if ($analytics->count() < 2) {
            return 0;
        }

        $first = (int) $analytics->first()->unique_users;
        $last = (int) $analytics->last()->unique_users;

        if ($first === 0) {
            return 0;
        }

        return round(
            (($last - $first) / $first) * 100,
            1
        );
    }
}
