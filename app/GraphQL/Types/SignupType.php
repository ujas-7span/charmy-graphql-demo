<?php

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SignupType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'signup',
        'description'   => 'signup type',
    ];

    public function fields(): array
    {
        return [
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'The user',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The token of user',
            ],
        ];
    }
}
