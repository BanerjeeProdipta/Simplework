<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create() {
        $articles = Auth::user()->firstOrFail()->articles;
        return view('contact', ['articles' => $articles]);
    }

    public function store() {
        request()->validate([
            'email' => 'required|email'
        ]);

       Mail::to(request('email'))
           ->send(new Contact());

       return redirect('/contact')
       ->with('success','Email sent!');
    }
}
