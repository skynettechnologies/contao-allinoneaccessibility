<?php

/*
 * All in One Accessibility extension for Contao Open Source CMS
 *
 * Copyright (C) 2023 Skynet Technologies USA LLC
 *
 * @author  Skynet Technologies USA LLC
 * @license MIT
 */
namespace Skynettechnologies\ContaoAllinoneaccessibility\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class SkynettechnologiesContaoAllinoneaccessibilityExtension.
 *
 * @codeCoverageIgnore
 */
class SkynettechnologiesContaoAllinoneaccessibilityExtension extends Extension
{
    /**
     * @throws \Exception
     */

    /* load listener.yml which is using call AioaTemplateListener.php */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('listener.yml');
    }
}
