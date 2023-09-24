<?php
namespace SLiMS\Template\components;

use SLiMS\Template\Skelton\AbstractComponent;

class Layout extends AbstractComponent
{
    public function getOutput():string
    {
        $script = $this->property?->script??'';
        $this->output = <<<HTML
        <!DOCTYPE Html>
        <html>
            <head>
                <title>{$this->property->title}</title>
                {$this->property->meta}
            </head>
            <body>
                {$this->property->maincontent}
                {$script}
            </body>
        </html>
        HTML;

        return $this;
    }
}
