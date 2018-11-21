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


HTMLHelper::stylesheet('plg_radicalmultifield_slideshowvertical/lightgallery.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::stylesheet('plg_radicalmultifield_slideshowvertical/lg-fb-comment-box.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::stylesheet('plg_radicalmultifield_slideshowvertical/lg-transitions.min.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_slideshowvertical/lightgallery.min.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

$id = rand(11111, 99999);
?>


<div id="lightgallery-<?= $id ?>">
    <?php foreach ($values as $key => $row): ?>
        <a href="<?= $row['image']?>">
            <img src="<?= $row['image']?>"  alt="<?= $row['alt'] ?>">
        </a>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    lightGallery(document.getElementById('lightgallery-<?= $id ?>'), {
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false
    });
</script>
