<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    /** @var Request */
    protected $request;

    /** @var Builder */
    protected $builder;

    /**
     * BaseFilter constructor.
     *
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the given search filters.
     *
     * @param  Builder  $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            $this->callMethod($name, $value);
        }

        return $this->builder;
    }

    /**
     * The search filters (query strings) from the request.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    /**
     * Call the method name on the class extending this class.
     *
     * @param  string  $name
     * @param  mixed  $value
     */
    protected function callMethod($name, $value)
    {
        if (method_exists($this, $name)) {
            call_user_func_array([$this, $name], $this->cleanValue($value));
        }
    }

    /**
     * Get rid of any values that are falsy including empty strings.
     *
     * @param  mixed  $value
     * @return array
     */
    protected function cleanValue($value)
    {
        return array_filter([$value]);
    }
}
