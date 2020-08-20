<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    
    // protected $fillable = ['article_id', 'user_id', 'reply'];
    protected $guarded = [];
    
    public function article(){
        return $this->belongsTo(Article::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
