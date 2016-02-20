<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
        array(
            'TrackLab\Controllers' => $config->application->controllersNamespaces,
            'TrackLab\Controllers\Models' => $config->application->controllersModelsNamespaces,
            'TrackLab\Models' => $config->application->modelsNamespaces,
            'TrackLab\Services' => $config->application->servicesNamespaces,
            'TrackLab\Trigger' => $config->application->triggerNamespaces,
            'TrackLab\Handler' => $config->application->handlerNamespaces,
        )
)->register();
