<?php

namespace Instabot;

class Plugin
{
    /**
     * @var View
     */
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Plugin initialization
     */
    public function initialization()
    {
        if (!is_admin()) {
            $this->initPublic();
            return;
        }
        $this->initAdmin();
    }

    /**
     * Site content hooks
     */
    private function initPublic()
    {
        add_action('wp_head', function () {
            $apiKey = Settings::getApiKey();
            $runDelay = Settings::getRunDelay();
            if ($apiKey) {
                echo('
                    <script type = "text/javascript" >
                        (function() {
                          function runOnLoad() {
                            var element = document.createElement("script"),
                                tags = document.getElementsByTagName("script"),
                                m = tags[tags.length - 1];
                      
                            element.async = 0;
                            element.src = "https://widget.instabot.io/jsapi/rokoInstabot.js?apiKey='. rawurlencode($apiKey) .'";
                            m.parentNode.insertBefore(element, m);
                          }
                    
                          function instabotDelay() {
                              setTimeout(runOnLoad, '. $runDelay .');
                          }
                    
                          if (window.addEventListener) {
                              window.addEventListener("load", instabotDelay, false);
                    
                          } else if (window.attachEvent) {
                              window.attachEvent("onload", instabotDelay);
                          }
                        })();
                    </script>
                ');
            }
        });
    }

    /**
     * Admin hooks
     */
    private function initAdmin()
    {
        add_action('activate_' . INSTABOT_PLUGIN_BASENAME, function () {
            if (version_compare(PHP_VERSION, INSTABOT_PLUGIN_MIN_PHP_VERSION, '<')) {
                deactivate_plugins(INSTABOT_PLUGIN_BASENAME);
                wp_die('This plugin requires PHP Version ' . INSTABOT_PLUGIN_MIN_PHP_VERSION . '.  Sorry about that.');
            }
        });
        add_action('admin_menu', function () {
            add_menu_page('Instabot', 'Instabot', 'manage_options', Settings::GENERAL_SETTINGS, function () {
                $formHandler = new SettingsFormHandler($this->view);
                $formHandler->handle();
            }, $this->view->getAssetsPath() . 'menu-icon.png');
        });
        add_filter('plugin_action_links_' . INSTABOT_PLUGIN_BASENAME, function ($links) {
            return array_merge($links, array('<a href="' . admin_url('admin.php?page=' . Settings::GENERAL_SETTINGS) . '">Settings</a>'));
        });
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('instabot-admin-css', $this->view->getAssetsPath() . 'admin.css', [], INSTABOT_PLUGIN_VERSION);
        });
    }

}
