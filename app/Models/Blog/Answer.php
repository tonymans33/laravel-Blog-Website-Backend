<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['body', 'post_id', 'rate', 'user_id'];

    public function post(){ //belong to relation that each answer belongs to one post
        return $this->belongsTo('App\Models\Blog\Post');
    }

    public function users(){ //many to many relation that each user can have multiple answers
        return $this->belongsToMany('App\Models\Blog\User');
    }

    public function incRate(){ //function to increase rate property by 1
        $this->update(['rate' => $this->rate + 1]);
    }

    public function decRate(){ //function to decrease rate property by 1
        $this->update(['rate' =>$this->rate - 1]);
    }
    use HasFactory;
}
