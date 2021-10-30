<?php

namespace HexaStudio\Library\Net;

class HTMLTextNode extends Element
{
    private string $value;

    public function __construct(string $value)
    {
        parent::__construct("text");
        $this->value = $value;
    }

    public function parse(): string
    {
        return $this->value;
    }
}