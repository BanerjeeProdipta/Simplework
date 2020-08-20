<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Article;
use App\Tag;
use App\User;
use App\Reply;
use Image;
class ArticleController extends Controller
{
   
    public function welcome( ) {
        return view('welcome');
    }

    public function show( Article $article) {
        // $this->authorize('view', $article);
        $articles = Article::all();
        $replies = Reply::where('article_id', $article->id)->latest()->get();
        // $replies = Article::where('id', $article->id)->firstOrFail()->replies;
        return view('articles.show', compact('article', 'articles', 'replies'));
    }

    public function index() {
        if (request('tag')){
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        }
        elseif (request('written_by')){
            $articles = User::where('name', request('written_by'))->firstOrFail()->articles;
        }
        else{
            $articles = Article::latest()->get();
            // $articles = Article::latest('updated_at')->get();
        }
        return view('articles.articles', ['articles' => $articles]);
    }

    public function about() {
        $articles = Article::take(4)->latest()->get();
        return view('about', ['articles' => $articles]);
    }

    public function profile() {
        
        $users =User::paginate(5);
        $articles = auth()->user()->articles;
        $replies = auth()->user()->replies;
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;
        return view('profile', compact( 'users', 'articles', 'replies','unreadNotifications','readNotifications'));
    }    


    public function store(Request $request, Article $article) {

        $this->validateArticle();
        $article->user_id = auth()->id();
        $article->title = $request->title;
        $article->excerpt = $request->excerpt;  
        $article->body = $request->body; 
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time(). '.' .$file->getClientOriginalExtension();
            $file->move('uploads/articles/',$filename);
            $article->photo_name = $filename;
        }
        $article->save();
        $article->tags()->attach(request('tags'));
        return redirect('/articles')->with('success','Your article has been saved');
        // $article = auth()->user()->articles()->create($article);
        // $article = new Article($this->validateArticle());
        // $article->user_id = 6;
        // $article->save();
        // $article->tags()->attach(request('tags'));
        // return redirect('/articles');
        // Article::create( $this->validateArticle());
        // return redirect()->back();
    }

    public function edit( Article $article ) {
        $this->authorize('update', $article);
        $articles = auth()->user()->articles;
        return view('articles.edit',compact('articles','article'));
    }

    public function update( Article $article) {
        $article->update( $this->validateArticle());
        return redirect('/articles/'.$article->id)->with('warning','Your article has been updated');
      }

      public function validateArticle() { //As both store and update validation are same 
          return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'exists:tags,id'
            ]);
      }

      public function destroy(Article $article)
      {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect('/articles')->with('danger','Your article has been deleted');
      }

}