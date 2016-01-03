<?php

/**
 * Contao Bundle swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['swatchbook'] = '{type_legend},type,headline,name,colorSources;{template_legend:hide},swatchbook_Template;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_content']['fields']['headline'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['headline'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'inputUnit',
    'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
    'eval'                    => array('maxlength'=>200,'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['swatchbook_Template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['swatchbook_Template'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('swatchbookPalettes', 'getElementTemplates'),
    'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['colorSources'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['colorSources'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'options_callback'        => array('swatchbookPalettes', 'swatchbookSelectColors'),
    'eval'                    => array('multiple'=>true,'tl_class'=>'clr m12'),
    'sql'                     => "text NULL"
);


class swatchbookPalettes extends \Backend
{
    /**
     * return array for options Content element
     */
    public function getListPalettes()
    {
        $res = \Database::getInstance()->query("SELECT * FROM tl_swatchbook ORDER BY id")->fetchAllAssoc();

        foreach($res as $key=>$value)
        {
            $items[$value['id']] = $value['title'];
        }

        return $items;
    }

    /**
     * Return all content element templates as array
     * @return array
     */
    public function getElementTemplates()
    {
        return $this->getTemplateGroup('sw_');
    }


    public function swatchbookSelectColors()
    {
        $row = \Database::getInstance()->execute("SELECT * FROM tl_swatchbook ORDER BY id");

        while($row->next())
        {
            $items[$row->id] = $row->title;
        }

        return $items;
    }
}