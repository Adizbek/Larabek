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
    private $showText = false;
    private $data = [];

    public $confirm = false;
    public $confirmTitle = 'Please confirm';
    public $confirmMessage = 'Do you want to process action ?';
    public $confirmOk = 'Yes';
    public $confirmCancel = 'No';

    public $batch = true;

    public function confirm()
    {
        $this->confirm = true;
        return $this;
    }

    public function confirmTitle($title)
    {
        $this->confirmTitle = $title;
        return $this;
    }

    public function confirmMessage($text)
    {
        $this->confirmMessage = $text;
        return $this;
    }

    public function confirmOk($text)
    {
        $this->confirmOk = $text;
        return $this;
    }

    public function confirmCancel($text)
    {
        $this->confirmCancel = $text;
        return $this;
    }

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
            'confirm' => $this->getConfirmData(),
            'showText' => $this->showText,
            'showIcon' => $this->showIcon,
            'data' => $this->data,
            'batch' => $this->batch
        ];
    }

    private function getConfirmData()
    {
        if ($this->confirm) {
            return [
                'title' => $this->confirmTitle,
                'message' => $this->confirmMessage,
                'ok' => $this->confirmOk,
                'cancel' => $this->confirmCancel
            ];
        } else {
            return null;
        }
    }
}
