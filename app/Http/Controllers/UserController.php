<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard()
    {
        $this->middleware('auth');
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('profile')->with('user', $user);
    }
}
