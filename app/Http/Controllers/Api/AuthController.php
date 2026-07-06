<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $success = $this->authService->attemptLogin($data['username'], $data['password']);

        if (!$success) {
            return response()->json(['message' => 'Username atau Password salah!'], 401);
        }

        return response()->json(['message' => 'Authenticated']);
    }
}
