<?php

namespace User\Presentation\User\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use User\Actions\GetUserProfileAction;
use User\Presentation\User\Resources\UserResource;

class GetUserProfileController
{
    public function __invoke(): JsonResponse
    {
        try {
            $user = GetUserProfileAction::new()->run();

            return response()->json([
                'data' => UserResource::make($user),
            ]);
        } catch (\Exception $ex) {
            Log::error('user profile failure', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
