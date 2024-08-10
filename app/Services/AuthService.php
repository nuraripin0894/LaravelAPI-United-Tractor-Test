<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    public function register(array $request)
    {
        // validasi
        $validator = Validator::make($request, [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        $token = Auth::login($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $request)
    {
        // validasi
        $validator = Validator::make($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $token = Auth::attempt($request);

        if (!$token) {
            throw new \Exception('Email or password invalid.');
        }

        $user = Auth::user();

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
