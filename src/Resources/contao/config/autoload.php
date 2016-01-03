<?php
/**
 * Contao Extension swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(
    array(
        'CtEye'
    )
);

/**
 * Register the classes
 */
ClassLoader::addClasses(array(
	// Classes
	'CtEye\Swatchbook'              => 'src/CtEye/swatchbook-bundle/src/Resources/contao/classes/Swatchbook.php',
    'CtEye\Sync'                    => 'src/CtEye/swatchbook-bundle/src/Resources/contao/classes/Sync.php',
    // Models
    'CtEye\SwatchbookModel'	        => 'src/CtEye/swatchbook-bundle/src/Resources/contao/models/SwatchbookModel.php',
    'CtEye\SwatchbookColorsModel'	=> 'src/CtEye/swatchbook-bundle/src/Resources/contao/models/SwatchbookColorsModel.php',
    //Module
    'CtEye\ModuleSwatchbook'	    => 'src/CtEye/swatchbook-bundle/src/Resources/contao/modules/ModuleSwatchbook.php'
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array (
    'ce_swatchbook'       		    => 'src/CtEye/swatchbook-bundle/src/Resources/contao/templates',
    'sw_default'       		        => 'src/CtEye/swatchbook-bundle/src/Resources/contao/templates',
    'sw_bootstrap'                  => 'src/CtEye/swatchbook-bundle/src/Resources/contao/templates',
	'swc_swatchbookItems'   	    => 'src/CtEye/swatchbook-bundle/src/Resources/contao/templates',
    'be_swatchbookSync'   	        => 'src/CtEye/swatchbook-bundle/src/Resources/contao/templates'
));
