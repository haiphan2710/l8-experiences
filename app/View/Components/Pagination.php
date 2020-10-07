<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    /**
     * The data of pagination
     *
     * @var LengthAwarePaginator
     */
    public $data;

    /**
     * Create a new component instance.
     *
     * @param LengthAwarePaginator $data
     *
     * @return void
     */
    public function __construct(LengthAwarePaginator $data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return $this->data->links('components.pagination');
    }
}
