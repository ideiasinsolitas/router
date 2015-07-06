<?php

namespace Deck\Router;

class Router
{

    /*
    * @var
    */
    protected $routes;

    public function __construct(array $routing = null)
    {
        $this->routes = new Collection();
        if ($routing) {
            $this->addRoutes($routing);
        }
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function addRoute(RouteInterface $route)
    {
        $this->routes->set($route->name, $route);
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $r) {
            $route = new Route($r['name'], $r['pattern'], $r['vars']);
            $this->addRoute($route);
        }
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function route($uri)
    {
        if (!is_string($uri)) {
            throw new \InvalidArgumentException('$uri must be string');
        }
        foreach ($this->routes->all() as $route) {
            $pattern = '/' . str_replace('/', '\/', $route->pattern) . '/';
            if (preg_match($pattern, $uri, $params) === 1) {
                if ($route->match($uri)) {
                    $route->setParams($params);
                    return $route;
                }
            }
        }
        return false;
    }
}
