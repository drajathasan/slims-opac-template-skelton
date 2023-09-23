<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2023-09-23 10:05:09
 * @modify date 2023-09-23 15:04:27
 * @desc [description]
 */
use SLiMS\Template\Skelton\Core as Template;

require __DIR__ . '/vendor/autoload.php';

// Initialization template instance
$template = new Template;

// set basic properties
$template->setProperty('notes', $notes??null);
$template->setProperty('subject', $subject??null);
$template->setProperty('metadata', $metadata??null);
$template->setProperty('maincontent', $main_content??'');
$template->setProperty('image_src', $image_src??'');

// Rendering opac to template
$template->render($opac??$this);
