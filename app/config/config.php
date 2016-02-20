<?php

return new \Phalcon\Config(array(
    'app' => array(
        'secret' => ''
    ),
    'mongo' => array(
        'connectionString' => 'mongodb://localhost:27017',
        'dbname' => 'trackLab',
        'useCreds' => false,
        'username' => '',
        'password' => ''
    ),
    'application' => array(
        'controllersNamespaces' => __DIR__ . '/../../app/controllers/',
        'controllersModelsNamespaces' => __DIR__ . '/../../app/controllers/models/',
        'logsDir' => __DIR__ . '/../../app/logs/',
        'modelsNamespaces' => __DIR__ . '/../../app/models/',
        'servicesNamespaces' => __DIR__ . '/../../app/services/',
        'triggerNamespaces' => __DIR__ . '/../../app/trigger/',
        'handlerNamespaces' => __DIR__ . '/../../app/handler/',
        'viewsDir' => __DIR__ . '/../../app/views/',
        'pluginsDir' => __DIR__ . '/../../app/plugins/',
        'libraryDir' => __DIR__ . '/../../app/library/',
        'cacheDir' => __DIR__ . '/../../app/cache/',
        'baseUri' => '/trackLab/',
    )
        ));
