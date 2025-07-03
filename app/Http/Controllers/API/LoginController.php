<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Check if a token already exists and is still valid
        $token = $user->tokens()->where('name', 'auth-token')->first();

        if ($token && $token->expires_at && $token->expires_at->isFuture()) {
            return response()->json([
                'token' => $token->plainTextToken ?? $token->token,
                'message' => 'Reusing existing token',
            ]);
        }

        // Delete old tokens
        $user->tokens()->delete();

        // Create a new token valid for 1 day
        $newToken = $user->createToken('auth-token', ['*'], now()->addDay());

        return response()->json([
            'token' => $newToken->plainTextToken,
            'message' => 'New token generated',
        ]);
    }
}
