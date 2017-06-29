<?php
namespace Concrete\Package\MauticTracker\Mautic;

use Concrete\Core\Asset\Asset;

class Tracker extends Asset
{
    private $url;
    private $parameters = [];

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setParam($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function getParam($key)
    {
        if ($this->hasParam($key)) {
            return $this->parameters[$key];
        }
    }

    public function hasParam($key)
    {
        return (isset($this->parameters[$key]) && $this->parameters[$key] != '');
    }

    public function getAssetDefaultPosition()
    {
        return Asset::ASSET_POSITION_FOOTER;
    }

    public function getAssetType()
    {
        return 'mautic-tracker';
    }

    public function __toString()
    {
        if ($this->url) {
            return sprintf("<script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','%s/mtc.js','mt');

    mt('send', 'pageview', %s);
</script>", $this->url, json_encode($this->parameters));
        }
        return '';
    }
}
