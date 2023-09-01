<?php

namespace App\Services;

use App\Models\User;
use App\Traits\SortTrait;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use PaginationTrait, SortTrait;

    private $userObj;

    public function __construct(User $userObj)
    {
        $this->userObj = $userObj;
    }

    public function signup($inputs)
    {
        $inputs["password"] = Hash::make($inputs["password"]);
        $user = $this->userObj->create($inputs);
        $token = $user->createToken('api')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        return $data;
    }

    public function login($inputs)
    {
        $user = $this->userObj->whereEmail($inputs['email'])->first();

        if (!empty($user) && Hash::check($inputs['password'], $user->password)) {
            $data['user'] = $user;
            $data['token'] = $user->createToken('api')->plainTextToken;
        }

        return $data;
    }
}
