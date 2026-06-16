<?php

namespace Post\Actions;

use Post\Tasks\CalculatePostAnalyticsMetaTask;
use Post\Tasks\FindPostByIdTask;
use Post\Tasks\GetDailyPostAnalyticsTask;
use Shared\Support\Action;

class GetPostAnalyticsSummaryAction extends Action
{
    public function run(
        int $postId,
        string $from,
        string $to,
    ): array {
        $post = FindPostByIdTask::new()->run($postId);

        $analytics = GetDailyPostAnalyticsTask::new()->run(
            postId: $postId,
            from: $from,
            to: $to,
        );

        $meta = CalculatePostAnalyticsMetaTask::new()
            ->run($analytics);

        return [
            'post_id' => $post->id,
            'title' => $post->title,

            'period' => [
                'from' => $from,
                'to' => $to,
            ],

            'analytics' => $analytics->values(),

            'meta' => $meta,
        ];
    }
}
