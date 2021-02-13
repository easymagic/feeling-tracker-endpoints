<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function emailExists($email){
        return (new self)->newQuery()->where('email',$email)->exists();
    }

    function populateSelf($data){
        if ($this->emailExists($data['email'])){
            return;
        }
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = Hash::make($data['password']);
        $this->save();
    }

    static function populate(){
        $list = [
            [
                'name'=>'username1',
                'email'=>'username1@gmail.com',
                'password'=>'password123'
            ],
            [
                'name'=>'username2',
                'email'=>'username2@gmail.com',
                'password'=>'password123'
            ]

        ];

        $list = collect($list);
        $list->each(function($item){

            (new self)->populateSelf($item);

        });
    }


}
