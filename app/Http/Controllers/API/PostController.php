<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Blog\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Function to Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(){
        return response()->json(['data' => PostResource::collection(Post::all()->sortByDesc("created_at"))]);
    }


    /**
     * Function to Store a newly created resource in storage.
     *
     * @param  $request $request
     * @return string
     */

    public function store(CreatePostRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = auth()->user()->id;
        $input['solved'] = false;

        return response()->json(['data' => new  PostResource(Post::create($input)), 'msg' => 'Post Created Successfully !']);

    }

    /**
     * Function to Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['data' => new PostResource($post)]);
    }


    /**
     * Function Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, $id){

        $post = Post::find($id);
        $input = $request->validated();
        $post->updated_at = Carbon::now();

        return response()->json(['data' => new PostResource($post->fill($input)), 'msg' => 'Post Updated successfully ! ']);
    }


    /**
     * set solved column to true .. by the creator of the post
     * @param $id
     * @return JsonResponse
     */
    public function solvedByCreator($id){
        $post = Post::find($id);
        return response()->json(['data' => $post->setSolved(), 'msg' => 'This Post has been solved !']);
    }

    /**
     * Function to return user posts
     * @return JsonResponse
     */
    public function UserPosts(){
        return response()->json(['data' => PostResource::collection(auth()->user()->posts->sortByDesc("created_at"))]);
    }
}
