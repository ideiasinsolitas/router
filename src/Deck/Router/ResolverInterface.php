<?php

namespace Deck\Router;

interface ResolverInterface
{
    /*
    *
    */
    const DECK_BASE_NAMESPACE = 'Deck\\';

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function resolve($resource);
}