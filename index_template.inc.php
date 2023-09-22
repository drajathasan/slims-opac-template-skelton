<?php
use SLiMS\Template\Skelton\Core as Template;

require __DIR__ . '/vendor/autoload.php';

$template = new Template;
$template->setProperty('notes', $notes??null);
$template->setProperty('subject', $subject??null);
$template->setProperty('metadata', $metadata??null);
$template->setProperty('maincontent', $main_content??'');
$template->render($opac??$this);
