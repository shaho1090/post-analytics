<?php

namespace Post\Presentation\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Post\Actions\GetPostAnalyticsSummaryAction;
use Post\Presentation\User\Requests\DailyAnalyticsRequest;
use Post\Presentation\User\Resources\PostAnalyticsSummeryResource;

class GetPostAnalyticsSummeryController extends Controller
{
    public function __invoke(
        int                   $id,
        DailyAnalyticsRequest $request,
    ): PostAnalyticsSummeryResource|JsonResponse
    {
        try {
            $result = GetPostAnalyticsSummaryAction::new()->run(
                postId: $id,
                from: $request->validated('from'),
                to: $request->validated('to'),
            );

            return new PostAnalyticsSummeryResource($result);

        } catch (\Exception $ex) {
            Log::error('post analytics summery failure:', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
