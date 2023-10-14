<?php

namespace App\GraphQL\Queries;

use App\Models\Boat;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BoatQuery extends Query
{
    protected $attributes = [
        "name" => "boat",
    ];

    public function type(): Type
    {
        return GraphQL::type("Boat");
    }

    public function args(): array
    {
        return [
            "id" => [
                "name" => "id",
                "type" => Type::int(),
                "rules" => ["required"],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Boat::findOrFail($args["id"]);
    }
}
