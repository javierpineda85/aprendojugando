<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commentable(){
        return $this-> morphedTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
