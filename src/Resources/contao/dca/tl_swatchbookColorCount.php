<?php

/**
 * Contao Extension swatchbookColorCount
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

$GLOBALS['TL_DCA']['tl_swatchbookColorCount'] = array
(
  'config' => array
  (
    'dataContainer'		=> 'Table',
    'sql'               => array
    (
        'keys' => array ('id' => 'primary')
    )
  ),
  'fields' => array
  (
    'id' => array
    (
        'sql'               => "int(10) unsigned NOT NULL auto_increment"
    ),
    'countColors' => array
    (
        'sql'               => "tinyint(4) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array
    (
        'sql'               => "int(10) unsigned NOT NULL default '0'"
    ),
   )
);