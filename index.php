<?php

use Deck\Router\Router;
use Deck\Router\Dispatcher;
use Deck\Router\ConfigLoader;
use Deck\Router\Resolver;

require 'vendor/autoload.php';

$loader = new ConfigLoader();
$config = $loader->load();

$router = new Router($config['routing']);
$resolver = new Resolver($config['settings']['packages']);
$dispatcher = new Dispatcher();

//$uri = $_SERVER['REQUEST_URI'];
$uri = "/welcome/hello/pedr2_o";
$route = $router->route($uri);

return $dispatcher->dispatch($route, $resolver);
