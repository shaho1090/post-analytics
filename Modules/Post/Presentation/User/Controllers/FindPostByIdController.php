<?php

namespace Post\Presentation\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Post\Actions\CreatePostAction;
use Post\Actions\FindPostByIdAction;
use Post\Presentation\User\Requests\CreatePostRequest;
use Post\Presentation\User\Resources\PostResource;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class FindPostByIdController extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            $post = FindPostByIdAction::new()->run($id);

            return response()->json([
                'data' => PostResource::make($post->load('author')),
            ]);
        } catch (NotFoundResourceException $ex) {

            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
        } catch (\Exception $ex) {
            Log::error('finding the post failed', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
