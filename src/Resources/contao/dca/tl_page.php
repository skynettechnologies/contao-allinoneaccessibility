<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */

$GLOBALS['TL_CSS'][] = 'bundles/skynettechnologiescontaoallinoneaccessibility/css/aioa.css|static';
/**
 * Extend the palettes.
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'aioa_enable';

$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] .= ';{aioa_legend},aioa_enable';
if (isset($GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'])) {
    $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'] .= ';{aioa_legend},aioa_enable';
}

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['aioa_enable'] = 'aioa_license_key,aioa_color,aioa_position,aioa_icon_type,aioa_icon_size';

 /*
  * Add the fields
  */
 $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_enable'] = [
     'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_enable'],
     'exclude' => true,
     'inputType' => 'checkbox',
     'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
     'sql' => "char(1) NOT NULL default ''",
 ];

 $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_license_key'] = [
     'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_license_key'],
     'exclude' => true,
     'inputType' => 'text',
     'eval' => ['tl_class' => 'fullwidth-col-md-12','onkeyup' => "checkLicenseKey(this.value);",'placeholder' => 'License key required for full version'],
     'sql' => 'text NULL',
 ];

 $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_color'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_color'],
    'default' => '600b96',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength'=>6, 'size'=>1, 'colorpicker'=>true, 'isHexColor'=>true,'tl_class'=>'width-col-md-3','placeholder' => 'Hexa Color Code'),
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_position'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_position'],
    'default' => 'bottom_right',
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['bottom_right','bottom_left','bottom_center','top_left','top_right','top_center','middel_left','middel_right'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_position'],
    'eval' => ['tl_class'=>'width-col-md-3'],
    'sql' => 'text NULL',
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_type'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_type'],
    'exclude' => true,
    'default' => 'aioa-icon-type-1',
    'inputType' => 'radio',
    'options' => ['aioa-icon-type-1' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="65" height="65" id="aioa-icon-type-1-img" style="margin: auto"/>',
                'aioa-icon-type-2' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-2.svg" width="65" height="65" id="aioa-icon-type-2-img" style="margin: auto"/>',
                'aioa-icon-type-3' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-3.svg" width="65" height="65" id="aioa-icon-type-3-img" style="margin: auto"/>'],
    'eval' => ['tl_class'=>'width-col-md-12 common-class','style' =>'border:2px','onchange' => "ChangeIcon(this.value);"],
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_size'],
    'default' => 'aioa-medium-icon',
    'exclude' => true,
    'inputType' => 'radio',
    'options' => ['aioa-big-icon' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="75" height="75" style="margin: auto" class="icon-img"/>',
                'aioa-medium-icon' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="65" height="65" style="margin: auto" class="icon-img"/>',
                'aioa-default-icon' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="55" height="55" style="margin: auto" class="icon-img"/>',
                'aioa-small-icon' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="45" height="45" style="margin: auto" class="icon-img"/>',
                'aioa-extra-small-icon' => '<img src="https://skynettechnologies.com/sites/default/files/python/aioa-icon-type-1.svg" width="35" height="35" style="margin: auto" class="icon-img"/>',
                    ],
    'eval' => ['tl_class'=>'common-class width-col-md-12'],
    'sql' => "text NULL",
];

$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/skynettechnologiescontaoallinoneaccessibility/js/aioa.js|static';


