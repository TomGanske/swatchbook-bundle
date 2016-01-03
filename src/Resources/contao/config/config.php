<?php

/**
 * Contao Bundle swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */



/**
 * Backend
 */
array_insert($GLOBALS['BE_MOD'],0, array('CtEye' 	=> array
(
	'swatchbook'	=> array
	(
		'tables' 	=> array('tl_swatchbook','tl_swatchbookColors','tl_swatchbookColorCount'),
        'icon'      => 'bundles/swatchbook/images/icon.png',
        'sync'      => array('Sync', 'writeCSS'),
	)
)));

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['swatchbook'] = array('swatchbook' => 'Swatchbook');


/**
 * System Message Hook
*/
$GLOBALS['TL_HOOKS']['getSystemMessages'][] = array('Sync', 'syncSwatchbookColors');