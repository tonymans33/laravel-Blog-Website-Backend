<?php

namespace App\Http\Resources;

use App\Models\Blog\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'category' => new CategoryResource(Category::find($this->category_id)),
            'user' => new UserResource(User::find($this->user_id)),
            'created_at' => $this->created_at,
            'answers' =>  AnswerResource::collection($this->answers->sortByDesc("created_at")),
            'solved' => $this->solved,
        ];
    }
}
