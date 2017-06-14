<?php
namespace Concrete\Package\MauticTracker\Controller\SinglePage\Dashboard\System\MauticTracker;

use Concrete\Core\Package\Package;
use \Concrete\Core\Page\Controller\DashboardPageController;

class Settings extends DashboardPageController
{
    public function view()
    {
        /** @var Package $pkg */
        $pkg = \Package::getByHandle('mautic_tracker');
        $url = $pkg->getFileConfig()->get('mautic.url');
        $this->set('url', $url);
    }

    public function updated()
    {
        $this->set('message', t("Settings saved."));
        $this->view();
    }

    public function save_settings()
    {
        if (!$this->token->validate('save_settings')) {
            $this->error->add($this->token->getErrorMessage());
        }

        $url = $this->post('url');
        if (!$url) {
            $this->error->add(t('Mautic URL is required.'));
        }

        if (!$this->error->has()) {
            /** @var Package $pkg */
            $pkg = \Package::getByHandle('mautic_tracker');
            $pkg->getFileConfig()->save('mautic.url', $url);
            $this->redirect('/dashboard/system/mautic_tracker/settings','updated');
        }
    }
}