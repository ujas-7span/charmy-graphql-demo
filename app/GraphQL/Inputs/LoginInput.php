<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class LoginInput extends InputType
{
    protected $attributes = [
        'name'          => 'loginInput',
        'description'   => 'loginInput',
    ];

    public function fields(): array
    {
        return [
            'email' => [
                'type' => Type::string(),
                'description' => 'email',
                'rules' => ['required', 'email']
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'password',
                'rules' => ['required']
            ]
        ];
    }
}
