<?php
namespace SLiMS\Template\components;

use SLiMS\Template\Skelton\AbstractComponent;

class Meta extends AbstractComponent
{
    public function getOutput():string
    {
        // Dynamic Meta
        $dynamicMeta = '';
        if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
            $notes = substr($notes??'', 0, 152) . '...';
            $dynamicMeta .= <<<HTML
                <meta name="description" content="{$notes}">
                <meta name="keywords" content="{$this->property->subject}">
            HTML;
        else:
            $libraryName = config('library_subname');
            $dynamicMeta .= <<<HTML
                <meta name="description" content="{$this->property->title}">
                <meta name="keywords" content="{$libraryName}">
            HTML;
        endif;

        $lang = str_replace('-', '_', config('default_lang'));
        $dynamicMeta .= <<<HTML
            <meta property="og:locale" content="{$lang}"/>
            <meta property="og:type" content="book"/>
            <meta property="og:title" content="{$this->property->title}"/>
        HTML;


        // End dynamic meta

        $this->output = <<<HTML
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0"/>
        <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta name="generator" content="<?php echo SENAYAN_VERSION ?>">
        <meta name="theme-color" content="#000">
        {$dynamicMeta}
        HTML;
        return $this;
    }
}