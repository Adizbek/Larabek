<?php


namespace App\Extensions\TableBuilder\DataRenderer;


interface IRenderer
{
    public static function render($self, $columnName, $data);
}
