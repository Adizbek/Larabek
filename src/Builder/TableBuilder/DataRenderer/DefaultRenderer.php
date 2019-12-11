<?php


namespace Adizbek\GiveMeCrud\Builder\DataRenderer;


class DefaultRenderer implements IRenderer
{

    public static function render($self, $columnName, $data)
    {
        return $data[$columnName];
    }
}
