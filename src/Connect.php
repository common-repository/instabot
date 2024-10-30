<?php

namespace Instabot;

class Connect
{
    /**
     * @param string $key
     * @return string|null
     */
    public function getApplicationId($key)
    {
        $response = wp_remote_get(INSTABOT_PLUGIN_INSTABOT_API, ['headers' => [
            'Content-type' => 'application/json',
            'X-Instabot-Api-Key' => $key
        ]]);

        $result = json_decode($response['body']);

        if ($result->apiStatusCode === 'Success') {
            return $result->data->applicationId;
        }

        return null;
    }

}