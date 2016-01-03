<?php

/**
 * Contao Bundle swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CtEye;
use Contao\FrontendTemplate;
use Contao\System;


class Swatchbook extends \ContentElement
{
    protected $strTemplate = "ce_swatchbook";

    // Backend
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate                = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard 		= '### swatchbook ###';
            $objTemplate->title 		= $this->headline;
            $objTemplate->id 			= $this->id;
            $objTemplate->link 			= $this->name;
            $objTemplate->href 			= 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;

            return $objTemplate->parse();
        }


        if ($_SERVER['REQUEST_METHOD']=="POST" && \Environment::get('isAjaxRequest')) {
            $this->myGenerateAjax();
            exit;
        }


        return parent::generate();
    }


    // Frontend
    protected function compile()
    {
        \System::loadLanguageFile('fe_swatchbook');

        $swTemplate = new \FrontendTemplate($this->swatchbook_Template);


        $arrIds = deserialize($this->colorSources,true);

        if(count($arrIds) < 1) {
            $swTemplate->noResult       = $GLOBALS['TL_LANG']['FE']['swatchbook']['noResult'];
            $this->Template->element    = $swTemplate->parse();
        }
        else {
            $GLOBALS['TL_CSS'][]        = 'bundles/swatchbook/css/style.css';
            $GLOBALS['TL_CSS'][] 	    = 'bundles/swatchbook/css/divElements.css';
            $GLOBALS['TL_HEAD'][]       ='<script src="bundles/swatchbook/js/modernizr.custom.79639.js"></script>';
            $GLOBALS['TL_JQUERY'][]     = '<script src="bundles/swatchbook/js/jquery.swatchbook.js"></script>';
            $GLOBALS['TL_MOOTOOLS']     = '<script src="bundles/swatchbook/js/jquery-2.1.4.min.js"></script>';

            $source = SwatchbookModel::findMultipleByIds($arrIds);

            while ($source->next()) {
                $arrSource[$source->id] = $source->title;
            }


            $swTemplate->id             = $this->id;
            $swTemplate->sources        = $arrSource;
            $swTemplate->href           = $this->Environment->requestUri;
            $swTemplate->cssID          = $this->cssID[0];
            $swTemplate->class          = $this->cssID[1];
            $swTemplate->countPallets   = count($source);
            $swTemplate->palletText     = $GLOBALS['TL_LANG']['FE']['swatchbook']['fe_pallet'];



            if(\Input::post('id')==NULL){
                reset($arrSource);
                $id = key($arrSource);
            }
            else {
                $id = \Input::post('id');
            }

            /* Load Colors */
            $objTemplate = new \FrontendTemplate('swc_swatchbookItems');
            $objElements = SwatchbookColorsModel::getColorList($id);
            while($objElements->next()){
                $childList[$objElements->id] = $objElements->title;
            }

            // Palette Message
            $paletteMsg = SwatchbookModel::getPalletMessage($id);


            $objTemplate->id            = $id;
            $objTemplate->child_list    = $childList;
            $objTemplate->text          = $paletteMsg->text;
            $objTemplate->advice        = $paletteMsg->advice;
            $swTemplate->colorsPalette  = $objTemplate->parse();

            $this->Template->element = $swTemplate->parse();
        }

    }

    public function myGenerateAjax()
    {
        if(\Environment::get('isAjaxRequest') && \Input::post('id')) {


            $id                 = \Input::post('id');
            $objTemplate        =  new \FrontendTemplate('swc_swatchbookItems');
            $colList            = SwatchbookColorsModel::getColorList($id);
            $palletMsg          = SwatchbookModel::getPalletMessage($id);


            while($colList->next()){
                $arr[$colList->id] = $colList->title;
            }



            $objTemplate->id = $objTemplate->linkId = $id;
            $objTemplate->child_list                = $arr;
            $objTemplate->text                      = $palletMsg->text;
            $objTemplate->advice                    = $palletMsg->advice;

            echo $objTemplate->getResponse()->getContent();
        }
    }

}