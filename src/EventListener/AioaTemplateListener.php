<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */
namespace Skynettechnologies\ContaoAllinoneaccessibility\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\PageModel;

class AioaTemplateListener
{
    /**
     * It's called  the AioaTemplateListener
     * listener. 
     *
     * @Hook("replaceDynamicScriptTags", priority=-1)
     */
    public function onReplaceDynamicScriptTags(string $buffer): string
    {

        if (null !== ($rootPage = PageModel::findByPk($GLOBALS['objPage']->rootId)) && $rootPage->aioa_enable) {
            $data = $rootPage->row();
            
            if($data['aioa_color'] == '' || empty($data['aioa_color'])){
                $data['aioa_color'] ='600b96';
            }

            if($data['aioa_position'] == '' || empty($data['aioa_position'])){
                $data['aioa_position'] ='bottom_right';
            }

            /* load Js */
            $GLOBALS['TL_BODY'][] = "<script id='aioa-adawidget' src='https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#".str_replace('#', '', $data["aioa_color"])."&token=".$data['aioa_license_key']."&position=".$data['aioa_position'].".".$data['aioa_icon_type'].".".$data['aioa_icon_size']."' async='true'>
            </script>";
        }

        return $buffer;
    }


}
