<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextareaField extends Component
{
    public $label;

    public $name;

    public $id;

    public $type;

    public $placeholder;

    public $value;

    public function __construct($label, $name, $id = null, $type = 'text', $placeholder = '', $value = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.textarea-field');
    }
}
