<?php

namespace HexaStudio\Library\Net;


class HTMLSingleElement extends Element
{
    public function __construct(string $tag)
    {
        parent::__construct($tag);
    }

    public function parse(): string
    {
        $html = "<" . $this->tag;
        $html .= $this->buildAttr();
        $html .= ">";
        return $html;
    }
}