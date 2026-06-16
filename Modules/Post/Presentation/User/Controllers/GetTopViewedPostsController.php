<?php

namespace Post\Presentation\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Post\Actions\GetTopViewedPostsAction;
use Post\Presentation\User\Requests\TopViewedPostsRequest;
use Post\Presentation\User\Resources\TopViewedPostCollection;

class GetTopViewedPostsController extends Controller
{
    public function __invoke(
        TopViewedPostsRequest $request,
    )
    {
        try {
            $result = GetTopViewedPostsAction::new()->run(
                $request->integer('limit', 10)
            );

            return new TopViewedPostCollection(
                $result['posts'],
                $result['meta'],
            );

        } catch (\Exception $ex) {
            Log::error('post top viewed failure:', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
