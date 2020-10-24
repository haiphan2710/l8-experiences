<?php

namespace App\Http\Controllers\Api\Admin;

use App\Filters\UserFilter;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends ApiController
{
    /** @var User $resource */
    protected $resource = User::class;
    
    /**
     * Display a listing of the resource.
     *
     * @param UserFilter $filter
     *
     * @return JsonResponse
     */
    public function index(UserFilter $filter)
    {
        $users = User::select('*')
            ->search($filter)
            ->paginate(5);
        
        return $this->withSuccess('User List', $users);
    }
}
