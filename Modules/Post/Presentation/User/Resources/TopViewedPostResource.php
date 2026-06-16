<?php

namespace Post\Presentation\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopViewedPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'rank' => $this->rank,
            'post_id' => $this->post_id,
            'title' => $this->title,
            'author' => $this->author,
            'total_views' => (int)$this->total_views,
            'unique_users' => (int)$this->unique_users,
            'trend' => $this->trend,
            'created_at' => $this->created_at,
        ];
    }
}


