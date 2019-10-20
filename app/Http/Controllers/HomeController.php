<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(8);
        //$posts = Category::all();
        return view('admin/dashboard',compact('posts'))
                    ->with('post_count', Post::all()->count())
                    ->with('trashed_count', Post::onlyTrashed()->get()->count())
                    ->with('users_count', User::all()->count());
    }
}
