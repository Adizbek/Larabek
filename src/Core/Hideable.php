<?php

namespace Adizbek\Larabek\Core;

trait Hideable
{
    private $_onSheet = true;
    private $_onDetails = true;
    private $_onForm = true;

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
