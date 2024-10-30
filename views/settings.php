<div class="wrap">
    <img src="<?php echo $_asset_url('instabot-wordpress.png'); ?>" />

    <div class="instabot-settings__panel">
        <form method="post" action="<?php echo $formActionURL; ?>">
            <?php if ($isApiKeyValid): ?>
                <div class="instabot-settings__text">
                    Instabot is now ready to be configured and launched - <a target="_blank" href="https://docs.instabot.io/docs/quick-start?utm_source=wordpress_plugin_config_screen#section-2-where">Learn more</a>
                </div>

                <div class="instabot-settings__buttons">
                    <a class="button button-primary" target="_blank"
                       href="https://app.instabot.io/application-<?php echo $applicationId; ?>/products/instabot/conversations?utm_source=wordpress_plugin_config_screen">
                        Sign into Instabot portal
                    </a>
                </div>
                <div class="instabot-settings__reset-key">Something went wrong? <a href="<?php echo $formActionURL; ?>&reset">Reset your API key</a></div>
            <?php else: ?>
                <div>
                    <span class="instabot-settings__account">Instabot account</span>
                    <a href="mailto:help@instabot.io?subject=<?php echo rawurlencode('Question about Instabot Wordpress plugin'); ?>">Need help?</a> Email us at help@instabot.io
                </div>

                <div class="instabot-settings__row">
                    <div class="instabot-settings__row__label">Instabot API key</div>
                    <div>
                        <input name="api_key" class="instabot-settings__row__input" value="<?php echo $apiKey; ?>"/>
                        <a class="instabot-settings__row__link" target="_blank" href="https://docs.instabot.io/docs/web-basic-setup?utm_source=wordpress_plugin_config_screen#section-instabot-api-key">Find your Instabot API key</a>
                    </div>
                </div>

                <?php if ($apiKey && !$isApiKeyValid): ?>
                    <div class="instabot-settings__validation-error">Instabot API key is incorrect, please try again</div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="instabot-settings__row">
                <div class="instabot-settings__row__label">Instabot Run Delay</div>
                <div>
                    <input name="run_delay" class="instabot-settings__row__input" value="<?php echo $runDelay; ?>"/>
                    <div class="instabot-info">Delay(ms) before run plugin javascript. Up to <?php echo $runDelayMaxValue; ?> ms.</div>
                </div>
            </div>

            <?php if (!$isRunDelayValid): ?>
                <div class="instabot-settings__validation-error">Run Delay is incorrect, please try again</div>
            <?php endif; ?>

            <div class="instabot-settings__buttons">
                <button class="button button-primary">Save changes</button>
            </div>

            <?php if (!$isApiKeyValid): ?>
            <div class="instabot-settings__row">
                <div>
                    <a class="instabot-settings__row__link" target="_blank"
                       href="https://instabot.io/addinstabot?utm_source=wordpress_plugin_config_screen">Don't have an API key yet?</a>
                </div>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>