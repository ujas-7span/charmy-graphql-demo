<?php

namespace App\GraphQL\Types;

use App\Models\Country;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CountryType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'country',
        'description'   => 'country list',
        'model'         => Country::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the country',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of country',
            ],
        ];
    }
}
