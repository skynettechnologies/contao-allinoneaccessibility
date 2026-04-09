<?php
namespace Skynettechnologies\ContaoAllinoneaccessibility\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use Skynettechnologies\ContaoAllinoneaccessibility\ContaoAllinoneaccessibilityBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoAllinoneaccessibilityBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
