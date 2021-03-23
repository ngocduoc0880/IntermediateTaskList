<?php

namespace Tests\Feature;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testSucess()
    {
        $response = $this->postJson('api/login', ['email'=>'phamngocduoc08802@gmail.com','password'=>'123456']);
        $response->assertStatus(200);
    }

    public function testFailIncorrectUsernamePassword()
    {
        $response = $this->postJson('api/login', ['email'=>'phamngocduoc08802@gmail.com','password'=>'1234567']);
        $response->assertStatus(JsonResponse::HTTP_UNAUTHORIZED);
    }
}
