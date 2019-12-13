<?php


namespace Adizbek\GiveMeCrud\Builder\DataRenderer;


class DefaultRenderer implements IRenderer
{

    public function render($columnName, $data)
    {
        $keys = mb_split("\.", $columnName);
        $val = $data;
        foreach ($keys as $key) {
            $val = $val[$key];
        }
        return $val;
    }
}
