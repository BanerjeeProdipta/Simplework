<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    public function index( )
    {
        $articles = auth()->user()->articles;
        $unreadNotifications = auth()->user()->unreadNotifications;
        return view('home',[
            'tags' => Tag::all(),
            'articles' => $articles,
            'unreadNotifications' => $unreadNotifications
            ]);

    }
}
