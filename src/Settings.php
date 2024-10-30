<?php

namespace Instabot;

class Settings
{
    const GENERAL_SETTINGS = 'instabot';

    const INSTABOT_API_KEY = 'instabot-api-key';
    const INSTABOT_RUN_DELAY = 'instabot-run-delay';
    const INSTABOT_RUN_DELAY_DEFAULT_VALUE = 0;
    const INSTABOT_RUN_DELAY_MAX_VALUE = 60000;

    public static function getApiKey()
    {
        return get_option(self::INSTABOT_API_KEY);
    }

    public static function saveApiKey($value)
    {
        update_option(self::INSTABOT_API_KEY, $value);
    }

    public static function getRunDelay()
    {
        $value = get_option(self::INSTABOT_RUN_DELAY);
        return ($value === '0' || $value) ? (int)$value : self::INSTABOT_RUN_DELAY_DEFAULT_VALUE;
    }

    public static function saveRunDelay($value)
    {
        update_option(self::INSTABOT_RUN_DELAY, $value);
    }

}