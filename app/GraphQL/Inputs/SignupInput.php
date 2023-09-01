<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class SignupInput extends InputType
{
    protected $attributes = [
        'name'          => 'signupInput',
        'description'   => 'signupInput',
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'name',
                'rules' => ['required']
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'email',
                'rules' => ['required', 'email', 'unique:users,email']
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'password',
                'rules' => ['required', 'min:6']
            ]
        ];
    }
}
