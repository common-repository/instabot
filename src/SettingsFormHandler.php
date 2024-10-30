<?php

namespace Instabot;

class SettingsFormHandler
{

    /**
     * @var View
     */
    private $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    /**
     * Handle requests to the form
     */
    public function handle()
    {
        $apiKey = null;
        $applicationId = null;
        $runDelay = Settings::getRunDelay();
        $isRunDelayValid = true;

        if (isset($_GET['reset'])) {
            Settings::saveApiKey('');
        } else {
            $apiKey = isset($_POST['api_key']) ? $_POST['api_key'] : Settings::getApiKey();

            if ($apiKey) {
                $connect = new Connect();
                $applicationId = $connect->getApplicationId($apiKey);

                if ($applicationId && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    Settings::saveApiKey($apiKey);
                }
            }

            if (isset($_POST['run_delay'])) {
                $runDelay = $_POST['run_delay'];
                $runDelayVal = filter_var($runDelay, FILTER_VALIDATE_INT, [
                    'options' => [
                        'min_range' => 0,
                        'max_range' => Settings::INSTABOT_RUN_DELAY_MAX_VALUE
                    ]
                ]);
                if($runDelayVal === 0 || $runDelayVal) {
                    Settings::saveRunDelay($runDelayVal);
                } else {
                    $isRunDelayValid = false;
                }
            }
        }

        $this->view->render('settings', [
            'formActionURL' => admin_url('admin.php?page=' . Settings::GENERAL_SETTINGS),
            'apiKey' => $apiKey,
            'runDelay' => $runDelay,
            'applicationId' => $applicationId,
            'isApiKeyValid' => (bool)$applicationId,
            'isRunDelayValid' => $isRunDelayValid,
            'runDelayMaxValue' => Settings::INSTABOT_RUN_DELAY_MAX_VALUE
        ]);
    }
}