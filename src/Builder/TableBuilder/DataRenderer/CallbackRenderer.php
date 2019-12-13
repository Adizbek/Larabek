<?php


namespace Adizbek\GiveMeCrud\Builder\DataRenderer;


class CallbackRenderer implements IRenderer
{

    public $callback;

    /**
     * CallbackRenderer constructor.
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
¬     * @param $columnName
     * @param $data
     * @return mixed
     */
    public function render($columnName, $data)
    {
        return call_user_func($this->callback, $columnName, $data);
    }
}
