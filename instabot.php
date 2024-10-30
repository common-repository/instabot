<?php
/*
Plugin Name:  Instabot
Plugin URI:   https://instabot.io/wordpressbot?utm_source=wordpress_plugin_config_page
Description:  Instabot - Instabot is a chatbot for your website, email, or mobile app and is the perfect solution to increase conversion rates. Instabot provides and collects user information, launching at key points, to personalize a user’s experience.
Version:      1.10
Author:       Instabot
Author URI:   https://instabot.io?utm_source=wordpress_plugin_config_page
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!function_exists('add_action')) {
    throw new \Exception('Can\'t be called directly');
}

if (defined('INSTABOT_PLUGIN_NAME')) {
    return;
}

define('INSTABOT_PLUGIN_NAME', 'instabot');
define('INSTABOT_PLUGIN_VERSION', '1.10');
define('INSTABOT_PLUGIN_DIR', __DIR__);
define('INSTABOT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('INSTABOT_PLUGIN_MIN_PHP_VERSION', '5.4.0');
define('INSTABOT_PLUGIN_INSTABOT_API', 'https://api.instabot.io/v1');

spl_autoload_register(function ($class) {
    if (preg_match('/^Instabot\\\\(.+)$/', $class, $match)) {
        $file = INSTABOT_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $match[1]) . '.php';
        if (is_readable($file)) {
            require_once $file;
        }
    }
}, true, true);

$plugin = new \Instabot\Plugin();
$plugin->initialization();
