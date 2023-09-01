<?php

namespace App\GraphQL\Query\Country;

use Closure;
use App\Services\CountryService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CountryResourceQuery extends Query
{
    protected $attributes = [
        'name' => 'country'
    ];

    private $countryServiceObj;

    public function __construct(CountryService $countryServiceObj)
    {
        $this->countryServiceObj = $countryServiceObj;
    }

    public function type(): Type
    {
        return GraphQL::type('country');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'alias' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $args['select'] = $fields->getSelect();
        $args['with'] = $fields->getRelations();
        return $this->countryServiceObj->resource($args['id'], $args);
    }
}
