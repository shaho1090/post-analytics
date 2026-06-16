<?php

namespace Post\Presentation\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostAnalyticsSummeryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'post_id' => $this['post_id'],

                'title' => $this['title'],

                'period' => $this['period'],

                'analytics' => $this['analytics'],

                'meta' => $this['meta'],
            ],
        ];
    }
}
