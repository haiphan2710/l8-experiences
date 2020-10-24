<?php
/**
 * Created by PhpStorm.
 * User: phangiahai
 * Date: 2020-10-23
 * Time: 10:30
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\API\ApiResponse;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    use ApiResponse;
    
    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param $expiredAt
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token, $expiredAt, $message = 'Success')
    {
        return $this->json(
            [
                'meta' => [
                    'success' => true,
                    'statusCode' => $this->getStatusCode(),
                    'message' => $message,
                ],
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $expiredAt,
                    'user' => $this->guard()->user(),
                ],
            ]
        );
    }
    
    /**
     * Get the guard to be used during authentication.
     *
     * @param string $guard
     *
     * @return Guard
     */
    public function guard($guard = 'api')
    {
        return Auth::guard($guard);
    }
}