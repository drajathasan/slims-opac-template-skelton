<?php
namespace SLiMS\Template\Skelton;

abstract class AbstractComponent
{
    protected string $name = '';
    protected ?object $property = null;
    protected string $output = '';

    public function __construct(?object $property = null)
    {
        $this->property = $property;
    }

    abstract public function getOutput():string;

    public function __toString():string
    {
        return $this->output;
    }
}