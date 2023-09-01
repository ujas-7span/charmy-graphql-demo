<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use Closure;
use GraphQL;
use App\Services\AuthService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Login mutation',
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
                'type' => GraphQL::type('loginInput'),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->authService->login($args['input']);
    }
}
