<?php

namespace Instabot;

class View
{
    /**
     * @return string
     */
    public function getAssetsPath()
    {
        return plugins_url() . '/' . INSTABOT_PLUGIN_NAME . '/assets/';
    }

    /**
     * @param string $template
     * @param array $data
     */
    public function render($template, array $data = [])
    {
        extract($data);
        extract([
            '_asset_url' => [$this, 'getAssetUrl']
        ]);
        require INSTABOT_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'views/' . $template . '.php';
    }

    /**
     * Templates helper functions
     */
    public function getAssetUrl($asset)
    {
        return $this->getAssetsPath() . $asset;
    }
}