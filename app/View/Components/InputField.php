<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
    public $label;

    public $name;

    public $id;

    public $type;

    public $placeholder;

    public $value;

    public $disabled;

    public $min;

    public $max;

    public function __construct($label, $name, $id = null, $type = 'text', $placeholder = '', $value = '', $disabled = false, $min = null, $max = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->min = $min;
        $this->max = $max;
    }

    public function render()
    {
        return view('components.input-field');
    }
}
