<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Summary of login: A public function that attempts to login the user and returns a token if it is authenticated.
     * @param \App\Http\Requests\LoginRequest $loginRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest) {
        
        // Retrieve the requestedBy
        $requestedBy = $loginRequest->input('requestedBy');

        // Log the requestedBy role
        Log::info('Login attempt', ['requestedBy' => $requestedBy]);

        // Retrieve the validated input data...
        $validated = $loginRequest->validated();

        // Attempt the user to login
        if(Auth::attempt($validated)) {
            // Get Authenticated User
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Get Token
            $token = $user->createToken('access_token')->plainTextToken;

            // Return Authenticated User
            return $this->jsonResponse([
                'user' => $user,
                'token' => $token,
                'role' => $requestedBy,
            ], 200);
        }

        // Return invalid credential response
        return $this->jsonResponse([
            'message' => 'Invalid credentials'
        ], 401);
      
    }
}
