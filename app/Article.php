<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    // Only Admin, When the request()->all() is not used 
    // protected $fillable = ['title', 'excerpt', 'body'];  

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function setBestReply(Reply $reply){
        $this->best_reply_id = $reply->id;
        $this->save();
    }

}