<?php

namespace Post\Presentation\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Post\Actions\CreatePostAction;
use Post\Presentation\User\Requests\CreatePostRequest;
use Post\Presentation\User\Resources\PostResource;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request): JsonResponse
    {
        try {
            $post = CreatePostAction::new()->run($request->validated() + [
                    'image' => $request->file('image'),
                ]
            );

            return response()->json([
                'data' => PostResource::make($post->load('author')),
            ]);
        } catch (\Exception $ex) {
            Log::error('post creation failed', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
