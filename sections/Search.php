<?php
namespace SLiMS\Template\Sections;

use SLiMS\Opac;
use SLiMS\Template\Skelton\AbstractSection;
use SLiMS\Template\Components\Layout;
use SLiMS\Template\Components\Meta;

class Search extends AbstractSection
{
    protected string $name = 'search';

    public function getOutput(Opac $opac):String
    {
        $meta = new Meta(property: $this->property);
        $this->property->title = $opac->page_title;
        $this->property->meta = $meta->getOutput() . ($this->property?->metadata??'');
        $layout = new Layout($this->property);
        
        return $layout->getOutput();
    }
}