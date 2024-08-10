<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
        $this->authService = $authService;
    }

    // register
    public function register(Request $request)
    {
        try {
            $data = $request->all();
            $result = $this->authService->register($data);

            return response()->json([
                'status' => true,
                'message' => 'Register Success.',
                'user' => $result['user'],
                'authorization' => [
                    'token' => $result['token'],
                    'type' => 'Bearer'
                ]
            ], 200);
        } catch (ValidationException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->errors()
            ], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Login success.',
                'user' => $result['user'],
                'authorization' => [
                    'token' => $result['token'],
                    'type' => 'Bearer'
                ]
            ], 200);
        } catch (ValidationException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->errors()
            ], 400);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage()
            ], 400);
        }
    }
}
