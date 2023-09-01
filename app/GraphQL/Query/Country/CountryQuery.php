<?php

namespace App\GraphQL\Query\Country;

use Closure;
use App\Services\CountryService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CountryQuery extends Query
{
    protected $attributes = [
        'name' => 'country list'
    ];

    private $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function type(): Type
    {
        return GraphQL::paginate('country');
    }

    public function args(): array
    {
        return [
            'perPage' => [
                'name' => 'perPage',
                'alias' => 'limit',
                'type' => Type::int(),
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int()
            ],
            'search' => [
                'name' => 'search',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $args['select'] = $fields->getSelect();
        $args['with'] = $fields->getRelations();
        return $this->countryService->collection($args);
    }
}
