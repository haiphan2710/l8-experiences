<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var Model $resource */
    protected $resource = null;

    /**
     * @param $id
     * @return mixed
     */
    protected function findResource($id)
    {
        abort_if(
            !is_a($this->resource, 'Illuminate\Database\Eloquent\Model', true),
            500,
            'PLEASE DEFINE RESOURCE AGAIN, MUST IS INSTANCE OF MODEL'
        );

        return $this->resource::findOrFail($id);
    }
}
