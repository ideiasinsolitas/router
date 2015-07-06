<?php

namespace Deck\Router;

class Dispatcher
{
    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function dispatch(RouteInterface $route, ResolverInterface $resolver)
    {
        $class = $resolver->resolve($route->controller);
        $controller = new $class();
        return array($controller, $route->action, $route->params);
    }
}
