<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'solved'];

    public function category(){ //belong to relation that each post belongs to one category
        return $this->belongsTo('App\Models\Blog\Category');
    }

    public function answers(){ //has many relation that each post can have many answers
        return $this->hasMany('App\Models\Blog\Answer');
    }

    public function setSolved(){ //function to close the post that means the post in has been solved
        $this->update(['solved' => true]);
    }

    use HasFactory;
}
