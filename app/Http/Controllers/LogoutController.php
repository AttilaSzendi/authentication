<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'you have successfully logged out'
        ]);
    }
}
