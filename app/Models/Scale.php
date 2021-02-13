<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;


    function nameExists($name){
        return (new self)->newQuery()->where('name',$name)->exists();
    }

    function populateMeOnce($data){

        if ($this->nameExists($data['name'])){
            return;
        }

        $this->name = $data['name'];
        $this->color = $data['color'];
        $this->scale_value = $data['scale_value'];
        $this->suggestion = $data['suggestion'];
        $this->save();

    }

    static function populate(){
        $data = [
            [
                'name'=>'Awful',
                'color'=>'red',
                'scale_value'=>1,
                'suggestion'=>'Please avoid negativiy.'
            ],
            [
                'name'=>'Fair',
                'color'=>'pink',
                'scale_value'=>2,
                'suggestion'=>'Congratulations, you are improving, keep up the pace.'
            ],
            [
                'name'=>'Good',
                'color'=>'white',
                'scale_value'=>3,
                'suggestion'=>'Congratulations, you are feeling good, however, you can still feel better'
            ],
            [
                'name'=>'Better',
                'color'=>'orange',
                'scale_value'=>4,
                'suggestion'=>'Congratulations, you are feeling better, you are just a step away to being amazing.'
            ],
            [
                'name'=>'Amazing',
                'color'=>'green',
                'scale_value'=>5,
                'suggestion'=>'Good job, keep it up.'
            ]


        ];

        $data = collect($data);

        $data->each(function($item){

            (new self)->populateMeOnce($item);

        });

    }


    static function fetch(){
        return (new self)->newQuery();
    }
}
