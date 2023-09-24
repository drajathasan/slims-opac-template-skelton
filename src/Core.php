<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2023-09-23 10:07:43
 * @modify date 2023-09-23 22:33:39
 * @desc Template skelton engine
 */
namespace SLiMS\Template\Skelton;

use SLiMS\Opac;
use SLiMS\Template\Sections\Home;
use SLiMS\Template\Sections\Detail;
use SLiMS\Template\Sections\News;
use SLiMS\Template\Sections\Login;
use SLiMS\Template\Sections\Visitor;
use SLiMS\Template\Sections\Content;
use SLiMS\Template\Sections\Search;

class Core
{
    protected string $pathOfTemplate = '';
    protected array $basicPages = [
        'show_detail' => Detail::class,
        'news' => News::class,
        'login' => Login::class,
        'visitor' => Visitor::class,
        'search' => Search::class,
    ];
    protected string $currentPage = '';
    protected ?object $property = null;

    /**
     * @param string $pathOfTemplate
     */
    public function __construct(string $pathOfTemplate = '')
    {
        $this->pathOfTemplate = $pathOfTemplate;
        if ($this->pathOfTemplate === '') {
            $trace = debug_backtrace(limit: 1)[0]??[];
            $this->pathOfTemplate = dirname($trace['file']) . DS;
        }

        $this->currentPage = basename($_GET['p']??$_GET['search']??Home::class);
        $this->property = new \stdClass;
        $this->setupBasicFile();
    }

    private function setupBasicFile()
    {
        if (file_exists($this->pathOfTemplate . 'detail_template.php')) return;
        
        if (!is_writable($this->pathOfTemplate)) die('Path ' . $this->pathOfTemplate . ' cannot be written!');

        $files = [
            'biblio_list_template.php', 'detail_template.php',
            'login_template.php', 'news_template.php',
            'visitor_template.php'
        ];

        foreach($files as $file) {
            copy(dirname(__DIR__) . DS . $file, $this->pathOfTemplate . $file);
        }
    }

    /**
     * Setting template property
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setProperty(string $name, mixed $value)
    {
        $this->property->$name = $value;
    }

    /**
     * Register another pages to processed 
     * by a section
     *
     * @param string $name
     * @param string $class
     * @return void
     */
    public function registerBasicPage(string $name, string $class):void
    {
        $this->currentPage[$name] = $class;
    }

    /**
     * redering content to each section instance
     *
     * @param Opac $opac
     * @return void
     */
    public function render(Opac $opac)
    {
        $sectionClass = $this->basicPages[$this->currentPage]??null;

        if ($sectionClass !== null) {
            $section = new $sectionClass(property: $this->property);
        } elseif ($sectionClass === null && count($_GET)) {
            $section = new Content(property: $this->property);
        } else {
            $section = new Home(property: $this->property);
        }

        echo $section->getOutput($opac);
    }
}