<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function posts(){ //has many relation that the category has many posts
        return $this->hasMany('App\Post');
    }

    use HasFactory;
}
