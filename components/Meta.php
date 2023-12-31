<?php
namespace SLiMS\Template\components;

use SLiMS\Template\Skelton\AbstractComponent;

class Meta extends AbstractComponent
{
    public function getOutput():string
    {
        // Dynamic Meta
        $libraryName = config('library_subname');
        $request_uri = urlencode(strip_tags(urldecode($_SERVER['REQUEST_URI'])));
        $dynamicMeta = '';
        if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
            $notes = substr($this->property->notes??'', 0, 152) . '...';
            $dynamicMeta .= <<<HTML
                <meta name="description" content="{$notes}">
                <meta name="keywords" content="{$this->property->subject}">
            HTML;
        else:
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

        if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
            $notes = substr($this->property->notes??'', 0, 152) . '...';
            $dynamicMeta .= <<<HTML
                <meta property="og:description" content="{$notes}"/>
            HTML;
        else:
            $dynamicMeta .= <<<HTML
                <meta property="og:description" content="{$libraryName}"/>
            HTML;
        endif;

        $url = $_SERVER["SERVER_NAME"] . $request_uri;
        $siteName = config('library_name');
        $dynamicMeta .= <<<HTML
            <meta property="og:url" content="//{$url}"/>
            <meta property="og:site_name" content="{$siteName}"/>
        HTML;

        if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
            $image_src = $_SERVER["SERVER_NAME"] . SWB . $this->property->image_src;
            $dynamicMeta .= <<<HTML
                <meta property="og:image" content="//{$image_src}"/>
            HTML;
        else:
            $image_src = $_SERVER["SERVER_NAME"] . SWB . config('template.dir');
            $dynamicMeta .=  <<<HTML
                <meta property="og:image" content="//{$image_src}/default/img/logo.png"/>
                HTML;
        endif;

        $dynamicMeta .= <<<HTML
            <meta name="twitter:card" content="summary">
            <meta name="twitter:url" content="//{$url}"/>
            <meta name="twitter:title" content="{$this->property->title}"/>
        HTML;
        
        if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')):
            $image_src = $_SERVER["SERVER_NAME"] . SWB . $this->property->image_src;
            $dynamicMeta .= <<<HTML
                <meta property="twitter:image" content="//{$image_src}"/>
            HTML;
        else:
            $image_src = $_SERVER["SERVER_NAME"] . SWB . config('template.dir');
            $dynamicMeta .= <<<HTML
                <meta property="twitter:image" content="//{$image_src}/default/img/logo.png"/>
            HTML;
        endif;

        // End dynamic meta

        $senayan_version = SENAYAN_VERSION;
        $this->output = <<<HTML
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0"/>
        <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta name="generator" content="{$senayan_version}">
        <meta name="theme-color" content="#000">
        {$dynamicMeta}
        HTML;
        return $this;
    }
}