<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public string $method;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $method)
    {
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
