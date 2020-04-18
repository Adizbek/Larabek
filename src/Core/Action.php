<?php


namespace Adizbek\Larabek\Core;


use Adizbek\Larabek\Core\Entity\Entity;
use Illuminate\Database\Eloquent\Collection;
use JsonSerializable;

abstract class Action implements JsonSerializable
{
    use Hideable;

    public abstract function actionName();

    public $icon = '';

    public $text = 'Action';

    private $showIcon = true;
    private $showText = true;
    private $data = [];

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

    public function withData(string $key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function clearData()
    {
        $this->data = [];

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
            'data' => $this->data,
        ];
    }
}
