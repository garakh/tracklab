<?php

use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\View,
    Phalcon\Mvc\Url as UrlResolver;

/*
  Прописываем маршурты клиентской части
 * */

foreach (array(
    'trigger/event',
    'trigger/people',
    'trigger/event/add',
    'trigger/event/edit/{id}',
    'trigger/people/add',
    'trigger/people/edit/{id}',
    'data/event',
    'test',

) as $route)
    $di->get('router')->add('/' . $route, array(
        "controller" => "index",
        "action" => "index")
    );
/*
$di->get('router')->add('/id{id:[a-z0-9]+}', array(
    "controller" => "index",
    "action" => "method")

);*/



