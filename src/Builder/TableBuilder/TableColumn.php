<?php


namespace Adizbek\GiveMeCrud\Builder\TableBuilder;


use Adizbek\GiveMeCrud\Builder\DataRenderer\CallbackRenderer;
use Adizbek\GiveMeCrud\Builder\DataRenderer\DefaultRenderer;
use Adizbek\GiveMeCrud\Builder\DataRenderer\IRenderer;

class TableColumn
{

    public $name;

    /**
     * @var IRenderer
     */
    protected $renderer;

    protected $label = null;
    protected $template = null;
    protected $width = null;

    /**
     * TableColumn constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getTitle()
    {
        return trans($this->label ?? $this->name);
    }

    public function renderData($data)
    {
        return $this->wrapTemplate($this->getRenderer()->render($this->name, $data));
    }

    protected function getRenderer(): IRenderer
    {
        $renderer = $this->renderer;

        if (is_callable($renderer)) {
            return new CallbackRenderer($renderer);
        } else if ($renderer instanceof IRenderer) {
            return $renderer;
        }

        return new DefaultRenderer();
    }

    protected function wrapTemplate($data)
    {
        if ($this->template === null) {
            return $data;
        }

        return view($this->template, ['data' => $data]);
    }

    /**
     * @param IRenderer|callable $renderer
     * @return TableColumn
     */
    public function setRenderer($renderer): TableColumn
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * @param string $label
     * @return TableColumn
     */
    public function setLabel($label): TableColumn
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $template
     * @return TableColumn
     */
    public function setTemplate($template): TableColumn
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @param string $width
     * @return TableColumn
     */
    public function setWidth($width): TableColumn
    {
        $this->width = $width;
        return $this;
    }

    public function getAttributes()
    {
        $attrs = " ";

        if ($this->width) {
            $attrs .= "width=\"$this->width\"";
        }

        return $attrs;
    }


}
