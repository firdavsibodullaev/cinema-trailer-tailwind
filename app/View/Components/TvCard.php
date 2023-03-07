<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TvCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Collection $tv)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.tv-card');
    }
}
