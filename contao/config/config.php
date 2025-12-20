<?php

/**
 * skynet_allinoneaccessibility extension for Contao Open Source CMS
 *
 * Cleaned-up version: Display All in One Accessibility widget settings in the backend module
 *
 * @author Skynet Technologies USA LLC
 * @license LGPL
 */

/**
 * Backend module
 * This registers the menu in Contao backend and shows HTML content via a callback
 */

$GLOBALS['BE_MOD']['system']['skynet_allinoneaccessibility'] = [
    'callback' => 'Skynettechnologies\ContaoAllinoneaccessibility\Controller\BackendModule\AllinoneaccessibilityModule'
];
$GLOBALS['FE_MOD']['application']['allinone_accessibility']
    = \Skynettechnologies\ContaoAllinoneaccessibility\Module\AllinoneAccessibilityModule::class;

