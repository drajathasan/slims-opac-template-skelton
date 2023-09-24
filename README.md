# Hi 👋
If you want to create your own SLiMS Template. Please follow this step:
1. Create your template directory inside <slims-root>/template/. E.g: my_template.
2. Create new file named with index_template.inc.php
3. Put this code into that file :
```php
<?php
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
```
4. Next you need composer to install this packages.
```bash
composer require slims/opac-template-skelton
```
5. Login into admin area, and change template in theme menu.
6. Choose "base" then open OPAC again.