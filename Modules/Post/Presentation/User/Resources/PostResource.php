<?php

namespace Post\Presentation\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Presentation\User\Resources\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'image' => $this->resource->image_url,
            'author' => UserResource::make(
                $this->whenLoaded('author')
            )
        ];
    }
}
