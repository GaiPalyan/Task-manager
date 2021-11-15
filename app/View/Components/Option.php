<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Option extends Component
{
    public string $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.default-selected-option');
    }
}
