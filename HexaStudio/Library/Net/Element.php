<?php

namespace HexaStudio\Library\Net;


abstract class Element
{
    protected string $tag;
    protected array $attr;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
        $this->attr = array();
    }

    public function setAttribute(string $key, string $value)
    {
        $this->attr[$key] = $value;
    }

    public function getAttribute(string $key): string
    {
        if (array_key_exists($key, $this->attr)) {
            return $this->attr[$key];
        } else {
            return "";
        }
    }

    protected function buildAttr(): string
    {
        $attr = "";

        foreach ($this->attr as $key => $item) {
            $attr .= " " . $key . "=\"" . $item . "\"";
        }

        return $attr;
    }

    public abstract function parse(): string;

    public static function parseByArray(array $element): Element
    {
        if (!isset($element["tag"]) || !isset($element["attr"]) || !isset($element["single"])) {
            throw new \Error("Error wrong object Type: parseByArray");
        }

        if ($element["tag"] === "TextNode") {
            return new HTMLTextNode($element["text"]);
        } else {
            if ($element["single"]) {
                $ele = new HTMLSingleElement($element["tag"]);
                foreach ($element["attr"] as $key => $attr) {
                    $ele->setAttribute($key, $attr);
                }
            } else {
                $ele = new HTMLElement($element["tag"]);
                foreach ($element["attr"] as $key => $attr) {
                    $ele->setAttribute($key, $attr);
                }

                if ($element["appends"]) {
                    foreach ($element["appends"] as $append) {
                        $ele->appendChild(self::parseByArray($append));
                    }
                }

            }
            return $ele;
        }
    }
}
