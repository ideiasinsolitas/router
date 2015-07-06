<?php

namespace Deck\Router;

interface RouteInterface
{
    public function match($uri);
}
