<?php

namespace Post\Actions;

use Post\Tasks\GetTopViewedPostsTask;
use Post\Tasks\CalculatePostTrendTask;
use Post\Tasks\CalculateTopViewedPostsMetaTask;
use Shared\Support\Action;

class GetTopViewedPostsAction extends Action
{
    public function run(int $limit = 10): array
    {
        $posts = GetTopViewedPostsTask::new()
            ->run($limit);

        $rank = 1;

        $posts = $posts->map(function ($post) use (&$rank) {

            $post->rank = $rank++;

            $post->trend = CalculatePostTrendTask::new()
                ->run($post->post_id);

            return $post;
        });

        return [
            'posts' => $posts,
            'meta' => CalculateTopViewedPostsMetaTask::new()
                ->run($posts),
        ];
    }
}
