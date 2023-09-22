<?php
namespace SLiMS\Template\Skelton;

use SLiMS\Opac;

use SLiMS\Template\Sections\Home;
use SLiMS\Template\Sections\Detail;
use SLiMS\Template\Sections\News;
use SLiMS\Template\Sections\Login;
use SLiMS\Template\Sections\Visitor;
use SLiMS\Template\Sections\Content;

class Core
{
    protected string $pathOfTemplate = '';
    protected array $basicPages = [
        'show_detail' => Detail::class,
        'news' => News::class,
        'login' => Login::class,
        'visitor' => Visitor::class
    ];
    protected string $currentPage = '';
    protected ?object $property = null;

    public function __construct(string $pathOfTemplate = '')
    {
        $this->pathOfTemplate = $pathOfTemplate;
        if ($this->pathOfTemplate === '') {
            $trace = debug_backtrace(limit: 1)[0]??[];
            $this->pathOfTemplate = dirname($trace['file']) . DS;
        }

        $this->currentPage = basename($_GET['p']??Home::class);
        $this->property = new \stdClass;
    }

    public function setProperty(string $name, mixed $value)
    {
        $this->property->$name = $value;
    }

    public function render(Opac $opac)
    {
        $sectionClass = $this->basicPages[$this->currentPage]??null;

        if ($sectionClass !== null) {
            $section = new Home(property: $this->property);
        } else {
            $section = new Home(property: $this->property);
        }

        echo $section->getOutput($opac);
    }
}