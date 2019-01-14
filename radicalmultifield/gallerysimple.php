<?php
/**
 * @package    Radical MultiField
 *
 * @author     delo-design.ru <info@delo-design.ru>
 * @copyright  Copyright (C) 2018 "Delo Design". All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://delo-design.ru
 */

defined('_JEXEC') or die;

use Joomla\Filesystem\Folder;

JFormHelper::loadFieldClass('subform');
JFormHelper::loadFieldClass('folderlist');
JLoader::register(
    'JFormFieldRadicalmultifield',
    JPATH_ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, ['plugins', 'fields', 'radicalmultifield', 'fields', 'radicalmultifield']) . '.php'
);

/**
 * Class JFormFieldRadicalmultifield_slideshowvertical
 */
class JFormFieldRadicalmultifield_gallerysimple extends JFormFieldRadicalmultifield
{


}