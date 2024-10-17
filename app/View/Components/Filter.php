<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public $options;
    public $defaultLabel;
    public $rowSelector;
    public $columnIndex;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, $rowSelector, $columnIndex, $defaultLabel = 'All Reports')
    {
        $this->options = $options;
        $this->defaultLabel = $defaultLabel;
        $this->rowSelector = $rowSelector;
        $this->columnIndex = $columnIndex;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter');
    }
}
