<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public string $method;
    /**
     * Create a new component instance.
     */
    public function __construct(string $method)
    {
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        //return view('components.form.form');
    }
}
