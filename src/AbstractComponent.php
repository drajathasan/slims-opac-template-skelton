<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2023-09-23 10:13:25
 * @modify date 2023-09-23 10:13:25
 * @desc [description]
 */
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