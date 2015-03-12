# router

Simple front controller implementation

```php

$uri = $_SERVER['REQUEST_URI'];
$routes = array(/* parsed from json */);

$router = new Router($routes);
$dispatcher = new Dispatcher();

$route = $router->route($uri);
$dispatcher->dispatch($route);
