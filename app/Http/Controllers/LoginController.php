<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            abort(Response::HTTP_UNAUTHORIZED, 'Wrong email or password');
        }

        /** @var User $user */
        $user = Auth::getUser();

        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken
        ]);
    }
}
