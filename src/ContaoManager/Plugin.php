<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */

namespace Skynettechnologies\ContaoAllinoneaccessibility\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Class Plugin.
 *
 * @codeCoverageIgnore
 */
class Plugin implements BundlePluginInterface
{
    /**
     * @return array
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Skynettechnologies\ContaoAllinoneaccessibility\SkynettechnologiesContaoAllinoneaccessibility')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
        ];
    }
}
