<?php

namespace Concrete\Package\MauticTracker;

use Concrete\Core\Package\Package;
use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;
use Concrete\Package\MauticTracker\Mautic\Tracker;

class Controller extends Package
{
    /**
     * Package handle.
     */
    protected $pkgHandle = 'mautic_tracker';

    /**
     * Required concrete5 version.
     */
    protected $appVersionRequired = '5.7.5';

    /**
     * Package version.
     */
    protected $pkgVersion = '0.1';

    /**
     * Remove \Src from package namespace.
     */
    protected $pkgAutoloaderMapCoreExtensions = true;

    /**
     * Returns the translated package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t("Add Mautic JS tracking code to every page. Easy access to custom parameters programmatically.");
    }

    /**
     * Returns the installed package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t('Mautic Tracker');
    }

    public function install()
    {
        $pkg = parent::install();
        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/singlepages.xml');
    }

    public function on_start()
    {
        $app = Application::getFacadeApplication();
        $pkg = $this;

        $app->singleton(Tracker::class, function ($app) use ($pkg) {
            $url = $pkg->getFileConfig()->get('mautic.url');
            $tracker = new Tracker();
            $tracker->setUrl($url);
            return $tracker;
        });

        $app->make('director')->addListener('on_before_render', function ($event) use ($app) {
            /** @var View $view */
            $view = $event->getArgument('view');
            if (!$app->make('helper/concrete/dashboard')->inDashboard()) {
                $view->addOutputAsset($app->make(Tracker::class));
            }
        });
    }
}
