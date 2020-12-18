<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answers\CreateAnswerRequest;
use App\Http\Requests\Answers\GiveAnswerRateRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Blog\Answer;
use App\Models\Blog\Post;
use App\Models\Blog\Rate;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;


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

            if( $answer->rate == 10 ){ //post solved case

                $answer->post->setSolved();
                return response()->json(['data' =>  $answer->rate, 'msg' => 'This Post has been solved !']);
            }
            else if($request->rate == 1){ //give rate = 1 case

                Rate::create([
                   'user_id' => $user_id,
                   'answer_id' => $answer->id
                ]);

                $answer->incRate(); //increase answer rate counter by 1

                return response()->json(['data' =>  $answer->rate, 'msg' => 'Answer rate increased !']);
            }

            else if($request->rate == 0){ //give rate = 0 case "dislike"

                Rate::where('answer_id', $answer->id)->where('user_id', $user_id)->delete(); //removing record from rates table

                $answer->decRate(); //decrease answer rate counter by 1

                return response()->json(['data' =>  $answer->rate, 'msg' => 'Answer rate decreased !']);

            }

        }
    }
}
