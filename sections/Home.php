<?php
namespace SLiMS\Template\Sections;

use SLiMS\Opac;
use SLiMS\Template\Skelton\AbstractSection;
use SLiMS\Template\Components\Layout;
use SLiMS\Template\Components\Meta;

class Home extends AbstractSection
{
    protected string $name = 'home';

    protected function setDefaultContent()
    {
        if ($this->property->maincontent === '') {
            $this->property->maincontent = <<<HTML
            <section>
                <div id="content">
                    <h1>Hi 👋, are you ready?</h1>
                    <p>Makes your awesome template!</p>
                </div>
            </section>
            HTML;
            $this->property->maincontent .= <<<HTML
            <style>
                section {
                    width: 100%;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                #content > h1 {
                    line-height: 0;
                }
            </style>
            HTML;
        }
    }

    public function getOutput(Opac $opac):String
    {
        $this->setDefaultContent();
        $meta = new Meta(property: $this->property);
        $this->property->title = $opac->page_title;
        $this->property->meta = $meta->getOutput() . ($this->property?->metadata??'');
        $layout = new Layout($this->property);
        
        return $layout->getOutput();
    }
}