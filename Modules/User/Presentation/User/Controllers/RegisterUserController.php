<?php

namespace User\Presentation\User\Controllers;

use User\Presentation\User\Requests\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use User\Actions\RegisterUserAction;

class RegisterUserController
{
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        try{
            RegisterUserAction::new()->run($request->validated());

            return response()->json([
                'message' => 'Registration is successfully done.'
            ],201);
        }catch (\Exception $ex){
            Log::error('user registration failed', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
