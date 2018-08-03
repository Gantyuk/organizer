<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersOnline = [];
        foreach (User::get() as $user) {
            if ($user->isOnline()) {
                $usersOnline[] = $user;
            }
        }
        return view('auth.admin.admin', [
            'users' => $usersOnline,
            'count_user' => User::get()->count(),
            'count_user_online' => count($usersOnline)
        ]);
    }
}
