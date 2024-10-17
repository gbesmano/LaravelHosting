<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputRadio extends Component
{
    public array $options;

    public string $name;

    /**
     * Create a new component instance.
     */
    public function __construct(array $options, string $name)
    {
        $this->options = $options;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-radio');
    }
}
