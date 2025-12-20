<?php

namespace Skynettechnologies\ContaoAllinoneaccessibility\Controller\BackendModule;

use Contao\BackendModule;

class AllinoneaccessibilityModule extends BackendModule
{
    protected $strTemplate = 'be_skynet_allinoneaccessibility';

    protected function compile(): void
    {
       
        $this->Template->title = 'All in One Accessibility';

    }
}