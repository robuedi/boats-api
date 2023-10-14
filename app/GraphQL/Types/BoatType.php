<?php

namespace App\GraphQL\Types;

use App\Models\Boat;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BoatType extends GraphQLType
{
    protected $attributes = [
        "name" => "Boat",
        "description" => "Collection of boats",
        "model" => Boat::class,
    ];

    public function fields(): array
    {
        return [
            "id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "The id of a particular boat",
            ],
            "name" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "The name of the boat",
            ],
            "description" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "The description of the boat",
            ],
            "year" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "The year the boat was created",
            ],
            "price" => [
                "type" => Type::nonNull(Type::float()),
                "description" => "The price of the boat",
            ],
            "length" => [
                "type" => Type::nonNull(Type::float()),
                "description" => "The length of the boat",
            ],
            "location" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "The location of the boat",
            ],
        ];
    }
}
