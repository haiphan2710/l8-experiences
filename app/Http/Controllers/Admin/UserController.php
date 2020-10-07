<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /** @var User $resource */
    protected $resource = User::class;

    /**
     * Display a listing of the resource.
     *
     * @param UserFilter $filter
     * @return View
     */
    public function index(UserFilter $filter)
    {
        $users = User::select('*')
            ->search($filter)
            ->paginate(5);

        return view('admin.user.index', compact('users'));
    }
}
