<?php

namespace App\GraphQL\Query\User;

use Closure;
use App\Services\UserService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserResourceQuery extends Query
{
    protected $attributes = [
        'name' => 'user resource query'
    ];

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'alias' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $args['select'] = $fields->getSelect();
        $args['with'] = $fields->getRelations();
        $args['id'] = !empty($args['id']) ? $args['id'] : auth()->user()->id;
        return $this->userService->resource($args['id'], $args);
    }
}
