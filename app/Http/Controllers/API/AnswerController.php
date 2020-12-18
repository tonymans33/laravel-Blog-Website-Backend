<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answers\CreateAnswerRequest;
use App\Http\Requests\Answers\GiveAnswerRateRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Blog\Answer;
use App\Models\Blog\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(CreateAnswerRequest $request, $id){

        if(Post::find($id)->solved == 0){

            $input = $request->validated();

            $input['rate'] = 0;
            $input['post_id'] = $id;
            $input['user_id'] = auth()->user()->id;
            $input['created_at'] = Carbon::now();

            $answer = Answer::create($input);

            return response()->json(['data' => new  AnswerResource($answer), 'msg' => 'Answer Created Successfully !']);
        }
        else{
            return response()->json(['msg' => 'You cannot post answers because the post has been solved ']);
        }

    }

    /**
     * @param GiveAnswerRateRequest $request
     * @param $id
     * @return JsonResponse
     * Function to give a rate to an answer and if the answer reach 10 rates the post will set to solved
     */
    public function rate(GiveAnswerRateRequest $request , $id){

        $answer = Answer::find($id);

        $user_id = auth()->user()->id;

        while($answer->rate <= 10) {
            if( $answer->rate == 10 ){
                $answer->post->setSolved();
                return response()->json(['data' =>  $answer->rate, 'msg' => 'This Post has been solved !']);
            }
            else if($request->rate == 1){

                $answer->users()->detach($user_id);
                $answer->users()->attach($user_id, ['rate' => true]);

                $answer->incRate();
                return response()->json(['data' =>  $answer->rate, 'msg' => 'Answer rate increased !']);
            }

            else if($request->rate == 0){

                $answer->users()->detach($user_id);

                $answer->users()->attach($user_id, ['rate' => false]);

                $answer->decRate();
                return response()->json(['data' =>  $answer->rate, 'msg' => 'Answer rate decreased !']);

            }

        }
    }
}
