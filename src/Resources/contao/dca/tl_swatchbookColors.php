<?php

/**
 * Contao Extension swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

$GLOBALS['TL_DCA']['tl_swatchbookColors'] = array
(
  'config' => array
  (
    'dataContainer'	    => 'Table',
    'ptable'            => 'tl_swatchbook',
    'sql'               => array
    (
       'keys' => array
        (
           'id' => 'primary',
           'pid' => 'index'
        )
    )
  ),

  'list' => array
  (
    'sorting' => array
    (
        'mode'			        => 4,
		'fields'		        => array('sorting'),
        'headerFields'			=> array('title'),
        'child_record_callback'	=> array('tl_swatchbookColors','listObjLabel')
	),
    'global_operations' => array
    (
      'all' => array
      (
        'label'         => &$GLOBALS['TL_LANG']['MSC']['all'],
        'href'          => 'act=select',
        'class'         => 'header_edit_all',
        'attributes'    => 'onclick="Backend.getScrollOffset()" accesskey="e"'
      )
    ),
    
    'operations' => array
    (
      'edit' => array
      (
          'label'         => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['edit'],
          'href'		  => 'act=edit',
          'icon'          => 'edit.gif'
      ),
      'copy' => array
      (
        'label'             => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['copy'],
        'href'              => 'act=copy',
        'icon'              => 'copy.gif'
      ),
      'cut' => array
      (
          'label'               => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['cut'],
          'href'                => 'act=paste&amp;mode=cut',
          'icon'                => 'cut.gif',
          'attributes'          => 'onclick="Backend.getScrollOffset()"'
      ),
      'show' => array
      (
          'label'       => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['show'],
          'href'        => 'act=show',
          'icon'        => 'show.gif'
      ),
      'delete'  => array(
          'label'             => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['show'],
          'href'              => 'act=delete',
          'icon'        => 'delete.gif'
      )
  ),
  ),
  'palettes' => array
  (
    'default'	=>'{info_legend},title,color;'

  ),
  'fields' => array
  (
    'id' => array
    (
        'sql'           => "int(10) unsigned NOT NULL auto_increment"
    ),
    'pid' => array
    (
       'foreignKey'     => 'tl_swatchbook.id',
       'sql'            => "int(10) unsigned NOT NULL default '0'"
    ),
    'sorting' => array
    (
        'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array
    (
        'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'title' => array
    (
      'label'           => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['title'],
      'exclude'         => true,
      'inputType'       => 'text',
      'eval'            => array('tl_class'=>'w50'),
      'sql'             => "varchar(255) NOT NULL default ''"
    ),
    'color' => array
    (
        'label'         => &$GLOBALS['TL_LANG']['tl_swatchbookColors']['color'],
        'exclude'       => true,
        'inputType'     => 'text',
        'eval'          => array('colorpicker'=>true,'tl_class'=>'w50'),
        'sql'           => "varchar(7) NOT NULL default ''"
    )
   )
);

class tl_swatchbookColors extends \Backend
{
    /**
     * label Callback
    */
    public function listObjLabel($arrRow)
    {
        $template = '<ul style="width:auto;height:auto;display:-webkit-flex;display:flex;margin:0;padding:0;justify-content:center;float:left;">
    				    <li style="list-style:none;color:#%s;text-align:center;width:60px;padding:5px 0;background-color:#%s;">#%s</li>
    				    <li style="list-style:none;padding:5px 0 5px 10px;text-transform:uppercase;">%s</li>
                     </ul>';

        $pos = strpos(substr(strtoupper($arrRow['color']),0,1),"F");


        return sprintf($template,
                       ($pos == 0) ? 'fff': '555' ,
                       $arrRow['color'],
                       $arrRow['color'],
                       $arrRow['title']
            );
    }

}