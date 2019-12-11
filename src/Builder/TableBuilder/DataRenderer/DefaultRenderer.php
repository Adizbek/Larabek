<?php


namespace App\Extensions\TableBuilder\DataRenderer;


class DefaultRenderer implements IRenderer
{

    public static function render($self, $columnName, $data)
    {
        return $data[$columnName];
    }
}
