<?php

namespace Post\Presentation\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TopViewedPostCollection extends ResourceCollection
{
    public function __construct(
        $resource,
        private readonly array $meta
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'data' => TopViewedPostResource::collection(
                $this->collection
            ),

            'meta' => $this->meta,
        ];
    }
}
