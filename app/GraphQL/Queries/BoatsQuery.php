<?php

namespace App\GraphQL\Queries;

use App\Models\Boat;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BoatsQuery extends Query
{
    protected $attributes = [
        "name" => "boats",
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Boat"));
    }

    public function resolve($root, $args)
    {
        return Boat::all();
    }
}

