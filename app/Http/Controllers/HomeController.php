<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);//->get();
        $events = Event::orderBy('date','desc')->paginate(5);//->get();
        
        return view('home')->with('posts', $posts)->with('events',$events);
    }
    public function dashboard()
    {
        //$this->middleware('auth');
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $posts = $user->posts()->paginate(10);
        return view('dashboard')->with('posts', $posts);
    }
    
}
