<?php

/**
 * @package    Radical MultiField
 *
 * @author     delo-design.ru <info@delo-design.ru>
 * @copyright  Copyright (C) 2018 "Delo Design". All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://delo-design.ru
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

if (!$field->value)
{
    return;
}

$values = json_decode($field->value, JSON_OBJECT_AS_ARRAY);
$listtype = $this->getListTypeFromField($field);


HTMLHelper::stylesheet('plg_radicalmultifield_gallerysimple/gallerysimple.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);


HTMLHelper::stylesheet('plg_radicalmultifield_gallerysimple/lightgallery.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::stylesheet('plg_radicalmultifield_gallerysimple/lg-fb-comment-box.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::stylesheet('plg_radicalmultifield_gallerysimple/lg-transitions.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_gallerysimple/lightgallery.min.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_gallerysimple/lg-zoom.min.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_gallerysimple/lg-thumbnail.min.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

JLoader::register(
    'JFormFieldRadicalmultifield_gallerysimple',
    JPATH_ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, ['plugins', 'radicalmultifield', 'gallerysimple', 'radicalmultifield', 'gallerysimple']) . '.php'
);


$id = rand(11111, 99999);
?>


<div class="gallerysimple" id="lightgallery-<?= $id ?>">
    <?php foreach ($values as $key => $row): ?>
        <a href="<?= $row['image']?>">
            <img src="<?= JFormFieldRadicalmultifield_gallerysimple::generateThumb($field, $row['image'])?>"  alt="<?= $row['alt'] ?>">
            <div>
                <span></span>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    lightGallery(document.getElementById('lightgallery-<?= $id ?>'), {
        thumbnail:true,
        animateThumb: true,
        showThumbByDefault: true,
        mode: 'lg-fade',
        cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)'
    });
</script>
