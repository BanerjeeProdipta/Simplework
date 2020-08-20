<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show(){
         $unreadNotifications = auth()->user()->unreadNotifications;
         $readNotifications = auth()->user()->readNotifications;
         $articles = auth()->user()->articles;
         
        return view('notification',[
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'articles' => $articles
        ]);
    }
}