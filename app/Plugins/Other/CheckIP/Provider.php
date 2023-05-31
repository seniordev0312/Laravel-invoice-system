<?php
/**
 * Provides everything needed for the Plugin
 */
$this->loadTranslationsFrom(__DIR__.'/Lang', 'Plugins/Other/CheckIP');
$this->loadViewsFrom(__DIR__.'/Views', 'Plugins/Other/CheckIP');

if (sc_config_global('CheckIP')) {
    // $this->mergeConfigFrom(
       //     __DIR__.'/config.php', 'key_define_for_plugin'
    // );

    app('router')->aliasMiddleware('check-ip', \App\Plugins\Other\CheckIP\Middleware\CheckIP::class);

    $configDefault = config('middleware.front');
    $configDefault[] = 'check-ip';
    config(['middleware.front' => $configDefault]);

    $configDefaultAdmin = config('middleware.admin');
    $configDefaultAdmin[] = 'check-ip';
    config(['middleware.admin' => $configDefaultAdmin]);
}