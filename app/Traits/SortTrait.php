<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SortTrait
{
    public function sortInput(&$query, $inputs)
    {
        if (empty($inputs['sort'])) {
            return $query;
        }
        $column = Str::snake($inputs['sort']['by']);
        return $query->orderBy($column, $inputs['sort']['order']);
    }
}
