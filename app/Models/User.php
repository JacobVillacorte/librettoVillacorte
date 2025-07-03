<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Check if a token is expired.
     */
    public function tokenIsExpired($token)
    {
        return $token->expires_at && Carbon::now()->greaterThan($token->expires_at);
    }

    /**
     * Create or reuse a token with 1-day expiry.
     * Returns the plain-text token.
     */
    public function createOrGetToken()
    {
        $tokenName = 'libretto-token';

        $existingToken = $this->tokens()->where('name', $tokenName)->first();

        if ($existingToken) {
            if ($existingToken->expires_at && Carbon::now()->lt($existingToken->expires_at)) {
                // Token is still valid, return token string stored in DB (hashed)
                return $existingToken->token;
            } else {
                // Token expired, delete it
                $existingToken->delete();
            }
        }

        // Create new token and set expiration
        $tokenResult = $this->createToken($tokenName);
        $token = $tokenResult->plainTextToken;

        $tokenModel = $tokenResult->token;
        $tokenModel->expires_at = Carbon::now()->addDay();
        $tokenModel->save();

        return $token;
    }
}
