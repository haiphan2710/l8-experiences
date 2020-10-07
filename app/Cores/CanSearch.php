<?php

namespace App\Cores;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait CanSearch
{
    /**
     *
     *
     * @param $query
     * @param BaseFilter $filters
     * @return Builder
     */
    public function scopeSearch($query, BaseFilter $filters)
    {
        return $filters->apply($query);
    }
}
