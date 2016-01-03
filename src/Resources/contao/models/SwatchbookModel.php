<?php

/**
 * Contao Bundle swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CtEye;

class SwatchbookModel extends \Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_swatchbook';

    public static function getPalletMessage($intId, array $arrOptions=array()) {
        $t = static::$strTable;

        $arrColumns = array("$t.id=?");

        return static::findBy($arrColumns, array((int) $intId), $arrOptions);
    }
}