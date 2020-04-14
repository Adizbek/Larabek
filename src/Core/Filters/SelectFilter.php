<?php


namespace Adizbek\Larabek\Core\Filters;


use Adizbek\Larabek\Core\Filter;

abstract class SelectFilter extends Filter
{
    public $options = [];
    public $defaultValue = null;

    public function setOptions($options)
    {
        $this->data['options'] = $this->options = $options;
    }

    public function setDefault($option)
    {
        $this->data['default'] = $this->defaultValue = $option;
    }

    public function getValue($index)
    {
        return $options[$index] ?? $this->defaultValue;
    }
}
