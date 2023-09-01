<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use Closure;
use GraphQL;
use App\Services\AuthService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;

class SignUpMutation extends Mutation
{
    protected $attributes = [
        'name' => 'SignUp mutation',
    ];

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function type(): Type
    {
        return GraphQL::type('signup');
    }

    public function args(): array
    {
        return [
            'input' => [
                'alias' => 'input',
                'type' => GraphQL::type('signupInput'),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->authService->signup($args['input']);
    }
}
