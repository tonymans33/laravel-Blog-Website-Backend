<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Blog\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){ //function to show all the categories
        return response()->json(['data' =>CategoryResource::collection(Category::all())]);
    }

    public function showPosts($id){ //function to show posts of specific category by given id
        return response()->json(['data' =>PostResource::collection(Category::find($id)->posts) ]);
    }
}
