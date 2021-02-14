<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCollectionUnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetchScales()
    {
        $response = $this->get('/api/fetch-scales');

        $response->assertStatus(200);
    }

    function test_fetchUsers(){
        $response = $this->get('/api/fetch-users');

        $response->assertStatus(200);
    }

    function test_fetchUser(){
        $response = $this->get('/api/fetch-user/username1@gmail.com');
        $response->assertStatus(200);
    }

    function test_addEmotionFeedback(){
        $response = $this->post('/api/add-emotion-feedback',[
            'email'=>'username1@gmail.com',
            'scale_value'=>'4',
            'feedback'=>'Feeling Fair'
        ]);
        $response->assertStatus(200);
    }

    function test_getMyEmotions(){
        $response = $this->get('/api/get-my-emotions/username1@gmail.com');
        $response->assertStatus(200);
    }

    function test_estimateMyCurrentMood(){
        $response = $this->get('/api/estimate-my-current-mood/username1@gmail.com');
        $response->assertStatus(200);
    }






}
