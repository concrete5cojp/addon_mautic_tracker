<?php
namespace Concrete\Package\MauticTracker\Controller\SinglePage\Dashboard\System;

use \Concrete\Core\Page\Controller\DashboardPageController;

class MauticTracker extends DashboardPageController
{
    public function view()
    {
        $this->redirect('/dashboard/system/mautic_tracker/settings');
    }
}