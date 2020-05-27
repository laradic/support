<?php

namespace Laradic\Support\Macros\EloquentCollection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;

class ToArrayWithRelations
{
    public function __invoke()
    {
        return function ($deep=false) use (&$fn) {
            $items = array_map(function (Model $item) use ($deep) {
                if ($deep) {
                    $relations = array_map(function ($value)  {
                        if ($value instanceof Collection) {
                            return $value->toArrayWithRelations(true);
                        }
                        return $value;
                    }, $item->getRelations());
                    return array_merge(
                        $item->toArray(),
                        $relations
                    );
                }
                return array_merge(
                    $item->toArray(),
                    $item->relationsToArray()
                );
            }, $this->items);
            return new static($items);
        };
    }
}

