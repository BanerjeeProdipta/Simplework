<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ArticleReply;


class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Article $article, Reply $replies, Request $request)
    {
        $this->validateReply();
        
        $replies->article_id = $article->id;
        $replies->user_id = auth()->id();
        $replies->reply = $request->reply;
        $replies->save();
        // Notification::send($article->user, new ArticleReply($article->user_id, $article->title, auth()->user()->name, $replies->reply ));
        $article->user->notify(new ArticleReply($article->id, $article->title, auth()->user()->name, $replies->reply ));
        // request()->user()->notify(new ArticleReply($article->user_id, $article->title, auth()->user()->name, $replies->reply ));
        return redirect()->back()->with('success','Your comment has been published');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article,Reply $reply)
    {
        $this->authorize('update', $reply);
        $articles = Article::all();
        return view('reply.edit', compact('reply','article','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, Reply $reply)
    {
        $reply->update( $this->validateReply());
        return redirect('/articles/'.$article->id)->with('warning','Your comment has been updated');
        // return redirect()->back()->with('Your comment has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */

    public function destroy( Article $article,Reply $reply)
    {   
        $this->authorize('delete', $reply);
        $reply->delete();
        return redirect('/articles/'.$article->id)->with('danger','Your comment has been deleted');
    }

    public function validateReply() { //As both store and update validation are same 
        return request()->validate([
            'reply' => 'required'
          ]);
    }
}
