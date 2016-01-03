<?php

/**
 * Contao Extension swatchbook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */
namespace CtEye;


use Contao\BackendTemplate;

class Sync
{

    private $isUpdate = false;

    /**
     * write SystemMessageHook if update necessary
    */
    public function syncSwatchbookColors()
    {
        // Count DataSet
        $sql = \Database::getInstance()->prepare("SELECT id FROM tl_swatchbookColors")->execute();

        // Load File
        $file  = new \File('src/CtEye/swatchbook-bundle/src/Resources/public/css/divElements.css');

        /**
         *  Dataset rows are not equal File rows
         *  @return SystemMessage => Sync
         */
        if($sql->numRows !== count($file->getContentAsArray())) {
            \Message::add($GLOBALS['TL_LANG']['swatchbook']['syncSystemMessage'], 'TL_ERROR');
            $this->isUpdate = true;
        }

        return '';
    }


    /**
     * create/update CSS File
     * file :: web/bundles/swatchbook/css/divElements.css
     */
    public function writeCSS()
    {
        $this->syncSwatchbookColors();

        $objTemplate             = new BackendTemplate('be_swatchbookSync');
        $objTemplate->hrefBack   = ampersand(str_replace('&key=sync', '', \Environment::get('request')));
        $objTemplate->goBack     = $GLOBALS['TL_LANG']['MSC']['goBack'];


        if(!$this->isUpdate)
        {
            $objTemplate->headline   = $GLOBALS['TL_LANG']['swatchbook']['syncHeadlineNo'];
            return $objTemplate->parse();
        }
        else {
            /**
             * load File if doesn`t exists
             */
            $file = new \File('src/CtEye/swatchbook-bundle/src/Resources/public/css/divElements.css');

            /**
             * result Color
             */
            $groupPallets = \Database::getInstance()->execute("SELECT pid,count(pid) AS count FROM tl_swatchbookColors GROUP BY pid")->fetchAllAssoc();
            $pallets = \Database::getInstance()->execute("SELECT id,pid,title,color FROM tl_swatchbookColors")->fetchAllAssoc();

            foreach ($groupPallets as $c)
            {
                $i = 1;

                foreach ($pallets as $v) {
                    if ($c['pid'] == $v['pid']) {

                        $pal[$v['pid']] = $v['pid'];

                        $css[] = sprintf("#sb-container-%s div:nth-child(%s){background-color: #%s;box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);-webkit-box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);-moz-box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);}",
                            $v['pid'],
                            ($i <= $c['count']) ? $i : $c['count'],
                            $v['color'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id'],
                            $v['id']
                        );
                        $i++;
                    }
                }
            }

            /**
             * write CSS content
            */
            \File::putContent('src/CtEye/swatchbook-bundle/src/Resources/public/css/divElements.css', implode("\n", $css));


            $objTemplate->headline = $GLOBALS['TL_LANG']['swatchbook']['syncHeadline'];
            $objTemplate->pallets = ($i > 1) ? sprintf($GLOBALS['TL_LANG']['swatchbook']['syncPalletMulti'],$i) : sprintf($GLOBALS['TL_LANG']['swatchbook']['syncPalletSingle'],$i);
            return $objTemplate->parse();
        }
    }

}