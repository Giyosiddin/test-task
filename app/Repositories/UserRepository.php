<?php

namespace App\Repositories;

use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\NewUserRequest;
use App\Traits\ResponseApi;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository
{
    use ResponseApi;

    public function register(NewUserRequest $request)
    {
       try{
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);
        return $this->success('You are registered successfully!', $user, 201);
       } catch(\Exception $e){
        return $this->error($e->getMessage(), $e->getCode());
       }
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->only('email','password');
        try {
            if (! $token = JWTAuth::attempt($data)) {
                return $this->error('Login details are invalid.', 400);
            }
            return $this->success('You are logined successfully!', $token, 200);
        } catch (JWTException $e) {
            return $this->error('Could not create token.', 500);
        }

    }

    public function logout($request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return $this->success('User has been logged out',true);
        } catch (JWTException $exception){
            return $this->error($exception->getMessage(),$exception->getCode());
        }
    }
}
