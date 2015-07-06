<?php

namespace Deck\Router;

class Route implements RouteInterface
{

    /*
     * @var
     */
    protected $name;

    /*
     * @var
     */
    protected $pattern; // '/blog/(\w+)/(\d+)/'

    /*
     * @var
     */
    protected $vars;

    /*
     * @var
     */
    protected $controller;

    /*
     * @var
     */
    protected $action;

    /*
     * @var
     */
    protected $params;


    public function __get($name)
    {
        $properties = array('name', 'pattern', 'controller', 'action', 'params');
        return in_array($name, $properties) ? $this->$name : null;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function __construct($name, $pattern, array $vars)
    {
        if (!is_string($name) && !is_string($resource) && !is_string($pattern)) {
            throw new \InvalidArgumentException('');
        }

        $this->name = $name;
        $this->pattern = $pattern;
        $this->vars = $vars;
    }
    
    protected function getController()
    {
        if (!isset($this->vars['controller'])) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        $var = $this->vars['controller'];
        unset($this->vars['controller']);
        return $var;
    }

    protected function getAction()
    {
        if (!isset($this->vars['action'])) {
            $var = 'indexAction';
            return $var;
        }

        $var = $this->vars['action'] . 'Action';
        unset($this->vars['action']);
        return $var;
    }


    protected function parseParams()
    {

        $this->controller = $this->getController();
        $this->action = $this->getAction();
        $this->params = $this->vars;
        unset($this->vars);
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function match($uri)
    {

        if (!is_string($uri)) {
            throw new \InvalidArgumentException('$uri must be string');
        }

        $pattern = '/' . str_replace('/', '\/', $this->pattern) . '/';
        return preg_match($pattern, $uri);
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function setParams($params)
    {

        array_shift($params);

        if (count($params) !== count($this->vars)) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        $vars = array();

        for ($i=0; $i < count($params); $i++) {
            $key = $this->vars[$i];
            $vars[$key] = $params[$i];
        }
        
        $this->vars = $vars;
        $this->parseParams($params);
    }
}
