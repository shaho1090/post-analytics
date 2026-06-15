<?php

namespace User\Presentation\User\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use User\Actions\LoginUserAction;
use User\Exceptions\WrongCredentialsException;
use User\Presentation\User\Requests\LoginUserRequest;

class LoginUserController
{
    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        try {
            $token = LoginUserAction::new()->run($request->validated());

            return response()->json([
                'access_token' => $token
            ]);
        } catch (WrongCredentialsException $ex) {

            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
        } catch (\Exception $ex) {
            Log::error('user login failed', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong.'
            ], 400);
        }
    }
}
