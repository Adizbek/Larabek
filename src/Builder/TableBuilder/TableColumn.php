<?php


namespace Adizbek\GiveMeCrud\Builder\TableBuilder;


use App\Extensions\TableBuilder\DataRenderer\CallbackRenderer;
use App\Extensions\TableBuilder\DataRenderer\DefaultRenderer;
use App\Extensions\TableBuilder\DataRenderer\IRenderer;

class TableColumn
{

    public $name;

    /**
     * @var IRenderer
     */
    protected $renderer;

    public $options;

    protected $template;

    /**
     * TableColumn constructor.
     * @param $name
     * @param $options
     */
    public function __construct($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
        $this->renderer = $this->getRenderer($options);
        $this->template = isset($options['template']) ? $options['template'] : null;
    }

    public function getTitle()
    {
        return trans($this->options['label'] ?? $this->name);
    }

    public function renderData($data)
    {
        return $this->wrapTemplate($this->renderer->render($this->renderer, $this->name, $data));
    }

    protected function getRenderer($options): IRenderer
    {
        $renderer = isset($options['renderer']) ? $options['renderer'] : null;

        if (is_callable($renderer)) {
            return new CallbackRenderer($renderer);
        }

        return new DefaultRenderer();
    }

    protected function wrapTemplate($data)
    {
        if ($this->template === null) {
            return $data;
        }

        return view($this->template, ['data' => $data, 'options' => $this->options]);
    }
}
