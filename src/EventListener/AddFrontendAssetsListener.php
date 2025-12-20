<?php

namespace Skynettechnologies\ContaoAllinoneaccessibility\EventListener;

use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;

class AddFrontendAssetsListener
{
    /**
     * generatePage hook
     */
    public function __invoke(PageModel $page, LayoutModel $layout, PageRegular $pageRegular): void
    {
        // Inject JS
        $GLOBALS['TL_JAVASCRIPT'][] =
            'bundles/contaoAllinoneaccessibility/js/widget.js|static';
    }
}
