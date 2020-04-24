<?php


namespace Adizbek\Larabek\Core\Filters;


use Adizbek\Larabek\Core\Filter;

abstract class SelectFilter extends Filter
{
    public $options = [];

    public function setOptions($options)
    {
        $this->data['options'] = $this->options = $options;
    }

    public function setDefault($option)
    {
        $this->defaultValue = $option;
    }

    public function getValue($index)
    {
        return $this->options[$index] ?? $this->getValue($this->defaultValue);
    }

    public function getSelectedValue()
    {
        return $this->getValue($this->value);
    }
}
