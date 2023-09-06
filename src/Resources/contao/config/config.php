<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */

use Contao\System;
use Symfony\Component\HttpFoundation\Request;

/*
 * Backend modules
 */
$scopeMatcher = System::getContainer()->get('contao.routing.scope_matcher');
$currentRequest = System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('');



