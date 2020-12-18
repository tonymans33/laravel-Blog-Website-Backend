<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['user_id', 'answer_id'];

    public function answer(){ //belong to relation that each rate belongs to one answer
        return $this->belongsTo("App\Models\Blog\Answer");
    }

    public function user(){ //belong to relation that each rate belongs to one user
        return $this->belongsTo("App\Models\User");
    }
    use HasFactory;
}
