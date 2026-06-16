<?php

namespace Post\Presentation\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Post\Actions\GetPostDailyAnalyticsAction;
use Post\Presentation\User\Requests\DailyAnalyticsRequest;
use Post\Presentation\User\Resources\PostDailyAnalyticsResource;

class GetPostDailyAnalyticsController extends Controller
{
    public function __invoke(
        int                   $postId,
        DailyAnalyticsRequest $request
    ): JsonResponse|PostDailyAnalyticsResource
    {
        try {
            $result = GetPostDailyAnalyticsAction::new()->run(
                postId: $postId,
                from: $request->validated('from'),
                to: $request->validated('to'),
            );

            return new PostDailyAnalyticsResource($result);

        } catch (\Exception $ex) {
            Log::error('post daily analytics failure:', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
