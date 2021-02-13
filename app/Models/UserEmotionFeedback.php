<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmotionFeedback extends Model
{
    use HasFactory;


    static function factoryCreate($data){
        return (new self)->createFeedback($data);
    }

    function userIsValid($user_id){
        return (new User)->newQuery()->where('id',$user_id)->exists();
    }

    function scaleIsValid($scale_id){
        return (new Scale)->newQuery()->where('scale_id',$scale_id)->exists();
    }

    function createFeedback($data){

        if (!$this->userIsValid($data['user_id'])){
            return [
                'message'=>'Invalid user!',
                'error'=>true
            ];
        }


        if (!$this->scaleIsValid($data['scale_id'])){
            return [
                'message'=>'Invalid scale!',
                'error'=>true
            ];
        }


        $this->user_id = $data['user_id'];
        $this->scale_id = $data['scale_id'];
        $this->feedback = $data['feedback'];

        $this->save();

        return  [
            'message'=>'Feedback submitted succesfully.',
            'error'=>false
        ];

    }


}
