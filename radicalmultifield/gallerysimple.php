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

use Gumlet\ImageResize;
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


    /**
     * @param $field
     * @param $source
     * @return mixed
     */
    public static function generateThumb(&$field, $source)
    {
        $paths = explode(DIRECTORY_SEPARATOR, $source);
        $file = array_pop($paths);
        $fileSplit = explode('.', $file);
        $fileExt = array_pop($fileSplit);
        $extAccept = ['jpg', 'jpeg', 'png', 'gif'];

        if(!in_array($fileExt, $extAccept)) {
            return $file;
        }

        $pathThumb = implode(DIRECTORY_SEPARATOR, array_merge($paths, ['_thumb']));
        $pathFileThumb = implode(DIRECTORY_SEPARATOR, array_merge($paths, ['_thumb'])) . DIRECTORY_SEPARATOR . $file;
        $fullPathThumb =  JPATH_SITE . DIRECTORY_SEPARATOR . $pathThumb . DIRECTORY_SEPARATOR . $file;

        //если есть проевью, то отдаем ссылку на файл
        if(file_exists($fullPathThumb)) {
            return $pathFileThumb;
        }

        //если нет, генерируем превью

        //проверяем создан ли каталог для превью
        if(!file_exists(JPATH_SITE . DIRECTORY_SEPARATOR . $pathThumb)) {
            //создаем каталог
            Folder::create(JPATH_SITE . DIRECTORY_SEPARATOR . $pathThumb);
        }

        //подгружаем библиотеку для фото
        JLoader::registerNamespace('Gumlet', JPATH_SITE . '/' . implode(DIRECTORY_SEPARATOR , ['plugins', 'fields', 'radicalmultifield', 'libs', 'gumlet', 'lib']));

        //полгружаем хелпер
        JLoader::register('RadicalmultifieldHelper', JPATH_SITE . '/plugins/fields/radicalmultifield/radicalmultifieldhelper.php');

        //подгружаем параметры поля
        $params = RadicalmultifieldHelper::getParams($field->name);

        copy(JPATH_SITE . DIRECTORY_SEPARATOR . $source, $fullPathThumb);
        $image = new ImageResize($fullPathThumb);

        $maxWidth = (int)$params['gallerysimplepreviewmaxwidth'];
        $maxHeight = (int)$params['gallerysimplepreviewmaxheight'];

        $image->resizeToBestFit($maxWidth, $maxHeight);
        $image->save($fullPathThumb);
        unset($image);

        return $pathFileThumb;

    }


}