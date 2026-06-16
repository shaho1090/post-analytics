<?php

namespace Post\Tasks;

use Carbon\Carbon;
use Post\Data\Models\Post;
use Post\Data\Models\PostView;
use Shared\Support\Task;

class StorePostViewTask extends Task
{
    public function run(Post $post)
    {
        $user = auth('sanctum')->user();

        $alreadyViewed = HasViewedPostTodayTask::new()->run(
            postId: $post->id,
            userId: $user?->id,
            ipAddress: request()->ip(),
            date: Carbon::now(),
        );

        if ($alreadyViewed) {
            return;
        }

        PostView::query()->create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'view_date' => today(),
            'viewed_at' => now(),
        ]);
    }

}
