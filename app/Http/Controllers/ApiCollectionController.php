<?php

namespace App\Http\Controllers;

use App\Models\Scale;
use App\Models\User;
use App\Models\UserEmotionFeedback;
use Illuminate\Http\Request;

class ApiCollectionController extends Controller
{
    //

    function fetchScales(){
        return [
            'list'=>Scale::fetch()->get()
        ];
    }

    function fetchUsers(){
      return [
          'list'=>User::fetch()->get()
      ];
    }

    function fetchUser($email){
        return [
            'data'=>User::fetch()->where('email',$email)->first()
        ];
    }

    function addEmotionFeedback(){

        $data = [
            'email'=>request('email'),
            'scale_value'=>request('scale_value'),
            'feedback'=>request('feedback')
        ];

        $response = UserEmotionFeedback::factoryCreate($data);
        return $response;

    }

    function getMyEmotions($email){
//        $email = request('email');
        if (is_null(User::fetch()->where('email',$email)->first())){
            return [
                'list'=>[]
            ];
        }
        $user_id = User::fetch()->where('email',$email)->first()->id;
        return [
            'list'=>UserEmotionFeedback::fetch()->where('user_id',$user_id)->get()
        ];
    }

    function estimateMyCurrentMood($email){

        if (!User::userExists($email)){
            return [
                'data'=>[],
                'mesage'=>'User does not exist!',
                'error'=>true
            ];
        }

//        dd(UserEmotionFeedback::estimateMyCurrentMood($email)->get());

        return [
           'data'=>UserEmotionFeedback::estimateMyCurrentMood($email)
        ];

    }




}
