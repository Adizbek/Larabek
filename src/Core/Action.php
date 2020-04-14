<?php


namespace Adizbek\Larabek\Core;


use Adizbek\Larabek\Entity;
use Illuminate\Database\Eloquent\Collection;
use JsonSerializable;

abstract class Action implements JsonSerializable
{
    public abstract function actionName();

    public $icon = '';

    public $text = 'Action';

    private $showIcon = true;
    private $showText = true;

    public function showOnlyText()
    {
        $this->showText = true;
        $this->showIcon = false;

        return $this;
    }

    public function showOnlyIcon()
    {
        $this->showText = false;
        $this->showIcon = true;

        return $this;
    }

    public function showIconAndText()
    {
        $this->showText = true;
        $this->showIcon = true;

        return $this;
    }

    public abstract function handle(Entity $entity, $fields, Collection $models);


    public function jsonSerialize()
    {
        return [
            'icon' => $this->icon,
            'text' => $this->text,
            'name' => $this->actionName(),
            'showText' => $this->showText,
            'showIcon' => $this->showIcon,
        ];
    }
}
