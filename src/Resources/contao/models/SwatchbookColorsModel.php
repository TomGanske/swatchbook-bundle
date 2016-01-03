<?php

/**
 * Contao Extension swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CtEye;
use Contao\Model;

class SwatchbookColorsModel extends \Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_swatchbookColors';


    public static function getColorList($intParent, array $arrOptions=array()) {
        $t = static::$strTable;

        $arrColumns = array("$t.pid=?");

        return static::findBy($arrColumns, array((int) $intParent), $arrOptions);

    }
}