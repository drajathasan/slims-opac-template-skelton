<?php
namespace SLiMS\Template\Skelton;

use SLiMS\Opac;
use Ramsey\Collection\Collection;

abstract class AbstractSection
{
    protected string $name = '';
    protected ?object $property = null;
    protected Collection $component;

    public function __construct(array $items = [], ?object $property = null)
    {
        $this->property = $property;
        $this->component = new Collection(SLiMS\Template\Skelton\AbstractComponent::class);
        foreach ($items as $item) {
            $this->component->add($item);
        }
    }

    public function addComponent(AbstractComponent $componentInstance)
    {
        $this->component->add($componentInstance);
    }

    abstract public function getOutput(Opac $opac):String;
}