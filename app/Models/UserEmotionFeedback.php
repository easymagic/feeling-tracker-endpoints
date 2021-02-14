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

    static function fetch(){
      return (new self)->newQuery();
    }

    static function userIsValid($email){
        return (new User)->newQuery()->where('email',$email)->exists();
    }

    static function scaleIsValid($scale_value){
        return (new Scale)->newQuery()->where('scale_value',$scale_value)->exists();
    }

    function createFeedback($data){

        if (!$this->userIsValid($data['email'])){
            return [
                'message'=>'Invalid user!',
                'error'=>true
            ];
        }


        if (!$this->scaleIsValid($data['scale_value'])){
            return [
                'message'=>'Invalid scale!',
                'error'=>true
            ];
        }


        $this->user_id = User::fetch()->where('email',$data['email'])->first()->id; //  $data['user_id'];
        $this->scale_id = Scale::fetch()->where('scale_value',$data['scale_value'])->first()->id; // $data['scale_id'];
        $this->feedback = $data['feedback'];

        $this->save();

        return  [
            'message'=>'Feedback submitted succesfully.',
            'error'=>false
        ];

    }


}
