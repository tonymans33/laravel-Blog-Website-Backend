<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AnswerResource extends JsonResource
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
            'body' => $this->body,
            'created_at' => $this->created_at,
            'rate' => $this->rate,
            'check' => DB::table('answer_user')->where('answer_id', $this->id)->where('user_id', auth()->user()->id)->first()->rate

        ];
    }
}
