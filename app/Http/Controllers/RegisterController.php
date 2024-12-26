<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegistrationRequest $request)
    {
        $createInput = $request->validated();

        $createInput['password'] = Hash::make($createInput['password']);

        return User::query()->create($createInput);
    }
}
