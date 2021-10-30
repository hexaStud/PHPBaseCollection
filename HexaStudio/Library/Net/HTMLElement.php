<?php

namespace HexaStudio\Library\Net;

class HTMLElement extends Element
{
    /**
     * @var Element[]
     */
    private array $children;

    public function __construct(string $tag)
    {
        parent::__construct($tag);
        $this->children = array();
    }

    public function parse(): string
    {
        $html = "<" . $this->tag;
        $html .= $this->buildAttr();
        $html .= ">";

        $html .= $this->buildChildren();
        $html .= "</" . $this->tag . ">";

        return $html;
    }

    private function buildChildren(): string
    {
        $children = "";

        foreach ($this->children as $child) {
            if ($child instanceof Element) {
                $children .= $child->parse();
            }
        }

        return $children;
    }

    public function appendChild(Element $element)
    {
        if ($element instanceof HTMLElement || $element instanceof HTMLSingleElement || $element instanceof HTMLTextNode) {
            array_push($this->children, $element);
        }
    }
}