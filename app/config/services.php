<?php

use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\View,
    Phalcon\Mvc\Url as UrlResolver,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    Phalcon\Mvc\View\Engine\Volt as VoltEngine,
    Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter,
    Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config)
{
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
}, true);
$di->setShared('config', function() use ($config)
{
    return $config;
});
/**
 * Setting up the view component
 */
$di->set('view', function() use ($config)
{

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

// Регистрация диспетчера
$di->set('dispatcher', function()
{
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('TrackLab\Controllers');
    return $dispatcher;
});
/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function()
{
    return new MetaDataAdapter();
});
/**
 * Class Request
 */
$di->setShared('request', function()
{
    return new Phalcon\Http\Request();
});

$di->set('logger', function() use ($config)
{
    return new Phalcon\Logger\Adapter\File($config->application->logsDir . 'error' . date('Y-m-d') . '.log');
});

$di->set('bootstrap', array(
    'className' => 'TrackLab\Services\Bootstrap',
    'properties' => array(
    )
));

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function()
{
    $session = new SessionAdapter();
    $session->start();
    return $session;
});
$di->setShared('config', function() use ($config)
{
    return $config;
});
$di->set('mongo', function() use ($config)
{
    $mongo = new MongoClient($config->mongo->connectionString);
    return $mongo->selectDb($config->mongo->dbname);
});
/**
 * Register a collection manager
 */
$di->set('collectionManager', function()
{
    return new Phalcon\Mvc\Collection\Manager();
});




$di->set('eventService', array(
    'className' => 'TrackLab\Services\EventService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
        array(
            'name' => 'di',
            'value' => array('type' => 'parameter', 'value' => $di)
        ),
    ),
));

$di->set('peopleService', array(
    'className' => 'TrackLab\Services\PeopleService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
    )
));

$di->set('conditionService', array(
    'className' => 'TrackLab\Services\ConditionService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
    )
));


$di->set('projectService', array(
    'className' => 'TrackLab\Services\ProjectService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
    )
));

$di->set('triggerService', array(
    'className' => 'TrackLab\Services\TriggerService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
    )
));

$di->set('queryService', array(
    'className' => 'TrackLab\Services\QueryService',
    'properties' => array(
        array(
            'name' => 'config',
            'value' => array('type' => 'service', 'name' => 'config')
        ),
    )
));


$di->set('gateService', array(
    'className' => 'TrackLab\Services\GateService',
    'properties' => array(
        array(
            'name' => 'peopleService',
            'value' => array('type' => 'service', 'name' => 'peopleService')
        ),
        array(
            'name' => 'eventService',
            'value' => array('type' => 'service', 'name' => 'eventService')
        ),
        array(
            'name' => 'projectService',
            'value' => array('type' => 'service', 'name' => 'projectService')
        ),
    )
));
