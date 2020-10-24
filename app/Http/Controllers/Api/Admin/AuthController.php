<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends ApiController
{
    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     * @throws \Exception|Throwable
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        
        if (!Auth::attempt($credentials)) {
            return response()->json(
                [
                    'message' => 'Unauthorized',
                ], 401
            );
        }
        
        $user = $request->user();

//        $this->checkLoginTimes($user, $request);
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = ($request->remember_me)
            ? Carbon::now()->addWeek()
            : Carbon::now()->addDay();
        
        $token->save();
        
        return $this->respondWithToken($tokenResult->accessToken, $token->expires_at);
    }
    
    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     *
     * @return JsonResponse [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        
        return response()->json(
            [
                'message' => 'Successfully logged out',
            ]
        );
    }
    
    /**
     * Check User logged in
     * Note: Will revoke token if request contain new_auth param
     *
     * @param User         $user
     * @param LoginRequest $request
     *
     * @throws Throwable
     */
    protected function checkLoginTimes(User $user, LoginRequest $request)
    {
        if ($user->tokens()->count() > 0) {
            if (!$request->new_auth) {
                abort(401, 'USER_LOGGED_IN');
            }
            
            $user->tokens()->delete();
        }
    }
}
