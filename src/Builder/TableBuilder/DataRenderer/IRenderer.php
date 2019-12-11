<?php


namespace Adizbek\GiveMeCrud\Builder\DataRenderer;


interface IRenderer
{
    public static function render($self, $columnName, $data);
}
