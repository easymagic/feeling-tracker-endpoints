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

    function scale(){
        return $this->belongsTo(Scale::class,'scale_id');
    }

    static function estimateMyCurrentMood($email){

        $userId = User::fetch()->where('email',$email)->first()->id;


//        $query = self::fetch()

        $avg = self::fetch()->where('user_id',$userId); //Scale::getAverageMood($email);
        $list = $avg->get();
        $list = collect($list);
        $list = $list->map(function($item){
            return [
                'scale_value'=>$item->scale->scale_value
            ];
        });
//        dd($list);

        $count = $list->count();

//        dd($count);

        $sum = $list->reduce(function($acc,$item){
            return $acc + $item['scale_value'];
        },0);

        $avg = (int) floor($sum /$count);

//        dd($avg);

        $resolvedScale = Scale::fetch()->where('scale_value',$avg)->first();

//        dd($resolvedScale);

        return [
            'avg'=>$avg,
            'name'=>$resolvedScale->name,
            'suggestion'=>$resolvedScale->suggestion
        ];

    }


}
