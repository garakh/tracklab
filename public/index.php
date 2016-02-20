<?php

error_reporting(E_ALL);
use TrackLab\Models\AppException;
try
{

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";
    include __DIR__ . "/../app/config/routes.php";
    include __DIR__ . "/../app/config/events.php";

    /**
     * Bootstrap
     */
    $di->get('bootstrap')->init();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();
} catch (AppException $e)
{
    http_response_code(400);
    $code = $e->getError();

    echo json_encode(array('response' => false, 'error' => $code, 'errorMessage' => $e->getMessage()));
} catch (\Exception $e)
{
    http_response_code(400);
    
    $logger = $di->get('logger');
    $logger->log($e->getMessage());
    echo json_encode(array('response' => false));
}
