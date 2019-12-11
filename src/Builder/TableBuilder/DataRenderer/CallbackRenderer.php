<?php


namespace App\Extensions\TableBuilder\DataRenderer;


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
     * @param $self CallbackRenderer
     * @param $columnName
     * @param $data
     * @return mixed
     */
    public static function render($self, $columnName, $data)
    {
        return call_user_func($self->callback, $columnName, $data);
    }
}
