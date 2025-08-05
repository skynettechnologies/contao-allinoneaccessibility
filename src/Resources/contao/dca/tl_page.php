<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */

use Contao\BackendUser;
use Contao\System;

System::loadLanguageFile('default');
$user = BackendUser::getInstance();


// Add user domain
$websitename = $_SERVER['HTTP_HOST'];

$packageType = "free-widget";

// Array of details to send
$arrDetails = array(
    'name' => $websitename,
    'email' => 'no-reply@' . base64_encode($websitename) . '.com',
    'company_name' => '',
    'website' => base64_encode($websitename),
    'package_type' => $packageType,
    'start_date' => date(DATE_ISO8601),
    'end_date' => '',
    'price' => '',
    'discount_price' => '0',
    'platform' => 'Contao',
    'api_key' => '',
    'is_trial_period' => '',
    'is_free_widget' => '1',
    'bill_address' => '',
    'country' => '',
    'state' => '',
    'city' => '',
    'post_code' => '',
    'transaction_id' => '',
    'subscr_id' => '',
    'payment_source' => ''
);

// First API URL to fetch autologin link
$apiUrl = "https://ada.skynettechnologies.us/api/get-autologin-link";

// Set up cURL for the first API request
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['website' => base64_encode($websitename)]));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

// Execute the request and get the response
$response = curl_exec($ch);
if (curl_errno($ch)) {

    return;
}
curl_close($ch);

// Decode the response to check if the link is present
$result = json_decode($response, true);
if (isset($result['link'])) {
    // Successfully got the link

} else {
    // Link not found, proceed with second API call


    // Second API URL to add user domain
    $secondApiUrl = "https://ada.skynettechnologies.us/api/add-user-domain";

    // Set up cURL for the second API request
    $ch = curl_init($secondApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrDetails));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    // Execute the second request and get the response
    $response = curl_exec($ch);
    if (curl_errno($ch)) {

        return;
    }
    curl_close($ch);

    // Decode the second response to handle the result
    $data = json_decode($response, true);

    if ($data['success']) {
    } else {
    }
}


// End user domain
$GLOBALS['TL_CSS'][] = 'bundles/skynettechnologiescontaoallinoneaccessibility/css/aioa.css|static';
/**
 * Extend the palettes.
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'aioa_enable';

/*
* Add (enable All in One Accessibility) checkbox field
*/
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] .= ';{aioa_legend},aioa_enable';
if (isset($GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'])) {
    $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'] .= ';{aioa_legend},aioa_enable';
}

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['aioa_enable'] = 'aioa_color,aioa_position_enable,aioa_position,aioa_custom_position_lr,aioa_custom_position_rl,aioa_custom_position_bt,aioa_custom_position_tb,aioa_widget_size,aioa_icon_type,aioa_customsize_enable,aioa_custom_size,aioa_icon_size';

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


$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_color'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_color'],
    'default' => '420083',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 6, 'size' => 1, 'isHexColor' => true, 'tl_class' => 'width-col-md-3 input-val', 'placeholder' => 'Hexa Color Code', 'onchange' => "saveData();"),
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_position_enable'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_position_enable'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'common-class width-col-md-12 input-val', 'onchange' => "saveData();"],
    'sql' => "text NULL",
    'save_callback' => [
        function ($value) {
            return $value ? '1' : '0';
        }
    ]
];


$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_position'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_position'],
    'default' => 'bottom_right',
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['bottom_right', 'bottom_left', 'bottom_center', 'top_left', 'top_right', 'top_center', 'middel_left', 'middel_right'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_position'],
    'eval' => ['tl_class' => 'width-col-md-3 input-val1 position-field', 'onchange' => "saveData();"],
    'sql' => 'text NULL',
];



// Custom position

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_custom_position_lr'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_lr'],
    'default' => '',
    'exclude' => true,
    'inputType' => 'text',
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_lr'],
    'eval' => array('tl_class' => 'width-col-md-6 input-val custom-position-field', 'onchange' => "saveData();"),
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_custom_position_rl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_rl'],
    'default' => 'To the right',
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['To the right', 'To the left'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_rl'],
    'eval' => ['tl_class' => 'width-col-md-6 input-val1 custom-position-field', 'onchange' => "saveData();"],
    'sql' => 'text NULL',
];


$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_custom_position_bt'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_bt'],
    'default' => '',
    'exclude' => true,
    'inputType' => 'text',
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_bt'],
    'eval' => array('tl_class' => 'width-col-md-6 input-val custom-position-field', 'onchange' => "saveData();"),
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_custom_position_tb'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_tb'],
    'default' => 'To the bottom',
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['To the bottom', 'To the top'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_position_tb'],
    'eval' => ['tl_class' => 'width-col-md-6 input-val1 custom-position-field', 'onchange' => "saveData();"],
    'sql' => 'text NULL',
];


// widget size

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_widget_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_widget_size'],

    'exclude' => true,
    'inputType' => 'radio',
    'options' => ['Regular Size', 'Oversize'],
    'eval' => ['tl_class' => 'common-class width-col-md-12 input-val', 'onchange' => "saveData();"],
    'sql' => 'text NULL',
    'save_callback' => [
        function ($value) {
            return ($value === 'Oversize') ? '1' : '0'; // Convert value before saving
        }
    ],
    'load_callback' => [
        function ($value) {
            return ($value === '1') ? 'Oversize' : 'Regular Size'; // Convert stored value back to readable text
        }
    ],

];



// $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_type'] = [
//     'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_type'],
//     'exclude' => true,
//     'default' => 'aioa-icon-type-1',
//     'inputType' => 'radio',
//     'options' => [],
//     'eval' => [
//         'tl_class' => 'width-col-md-12 common-class input-val',
//         'style' => 'border:2px',
//         'onchange' => "ChangeIcon(this.value);"
//     ],
//     'sql' => "text NULL",
// ];
$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_type'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_type'],
    'exclude' => true,
    'default' => 'aioa-icon-type-1',
    'inputType' => 'radio',
    'options' => [],
    'eval' => [
        'tl_class' => 'width-col-md-12 common-class input-val',
        'style' => 'border:2px',
        'onchange' => "ChangeIcon(this.value);",

    ],
    'sql' => "text NULL",
];


$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_type']['eval']['tl_class'] = 'aioa-radio-wrapper'; // Add the wrapper class for CSS purposes


for ($i = 1; $i <= 29; $i++) {
    $key = "aioa-icon-type-$i";
    $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_type']['options'][$key] = '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-' . $i . '.svg" width="65" height="65" id="aioa-icon-type-' . $i . '-img" style="margin: auto"/>';
}

// widget icon custom size



// $GLOBALS['TL_DCA']['tl_page']['fields']['aioa_customsize_enable'] = [
//     'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_customsize_enable'],
//     'exclude' => true,
//     'inputType' => 'checkbox',
//      'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_customsize_enable'],
//     'eval' => ['tl_class' => 'common-class width-col-md-12 input-val customsize-enable','onchange' => "saveData();"],
//     'save_callback' => [
//         function ($value1) {
//             return $value1 ? '1' : '0';
//         }
//     ],
// ];
$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_customsize_enable'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_customsize_enable'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'common-class width-col-md-12 input-val', 'onchange' => "saveData();"],
    'sql' => 'text NULL',
    'save_callback' => [
        function ($value) {
            return $value ? '1' : '0';
        }
    ]
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_custom_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_size'],
    'exclude' => true,
    'inputType' => 'text',
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_custom_size'],
    'eval' => ['tl_class' => 'width-col-md-6 input-val custom-size-field', 'onchange' => "saveData();"],
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['aioa_icon_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_size'],
    'default' => 'aioa-medium-icon',
    'exclude' => true,
    'inputType' => 'radio',
    'options' => [
        'aioa-big-icon' => '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-1.svg" width="75" height="75" style="margin: auto" class="icon-img"/>',
        'aioa-medium-icon' => '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-1.svg" width="65" height="65" style="margin: auto" class="icon-img"/>',
        'aioa-default-icon' => '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-1.svg" width="55" height="55" style="margin: auto" class="icon-img"/>',
        'aioa-small-icon' => '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-1.svg" width="45" height="45" style="margin: auto" class="icon-img"/>',
        'aioa-extra-small-icon' => '<img src="bundles/skynettechnologiescontaoallinoneaccessibility/icons/aioa-icon-type-1.svg" width="35" height="35" style="margin: auto" class="icon-img"/>',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['aioa_icon_size'],
    'eval' => ['tl_class' => 'width-col-md-12 input-val custom-icon-size', 'onchange' => "saveData();"],
    'sql' => "text NULL",
];


/* add aioa.js file for some logic. which are uses in setting form */
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/skynettechnologiescontaoallinoneaccessibility/js/aioa.js|static';
