<?php


namespace Adizbek\Larabek\Core;


use Illuminate\Database\Eloquent\Model;

abstract class Field implements \JsonSerializable
{
    protected $name;

    private $_onSheet = true;
    private $_onDetails = true;
    private $_onForm = true;

    /**
     * Field constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public abstract function type(): string;

    public abstract function transform(Model $model);

    public function getData(Model $model)
    {
        return [
            'type' => $this->type(),
            'name' => $this->getName(),
            'data' => $this->transform($model)
        ];
    }


    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'type' => $this->type()
        ];
    }

    public function isOnSheet(): bool
    {
        return $this->_onSheet;
    }

    public function isOnDetails(): bool
    {
        return $this->_onDetails;
    }

    public function isOnForm(): bool
    {
        return $this->_onForm;
    }

    public function onlyOnSheet(): self
    {
        $this->_onSheet = true;
        $this->_onDetails = false;
        $this->_onForm = false;

        return $this;
    }

    public function onlyOnDetails(): self
    {
        $this->_onSheet = false;
        $this->_onDetails = true;
        $this->_onForm = false;

        return $this;
    }

    public function onlyOnForm(): self
    {
        $this->_onSheet = false;
        $this->_onDetails = false;
        $this->_onForm = true;

        return $this;
    }

    public function onSheet(): self
    {
        $this->_onSheet = true;

        return $this;
    }

    public function onDetails(): self
    {
        $this->_onDetails = true;

        return $this;
    }

    public function onForm(): self
    {
        $this->_onForm = true;

        return $this;
    }

    public function notOnSheet(): self
    {

        $this->_onSheet = false;

        return $this;
    }

    public function notOnDetails(): self
    {
        $this->_onDetails = false;

        return $this;
    }

    public function notOnForm(): self
    {
        $this->_onForm = false;

        return $this;
    }
}
