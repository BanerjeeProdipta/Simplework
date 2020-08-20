<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentReceived;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(){
        $articles = auth()->user()->articles;
        return view('payment', [
        'articles' => $articles
        ]);
    }
    
    public function store(){
        //Notification::send(request()->user(), new PaymentReceived() );
        //user()->notify(new PaymentReceived());
        request()->user()->notify(new PaymentReceived(10));
        return redirect('payment')
        ->with('success','Payment Successful!');
    }
}
