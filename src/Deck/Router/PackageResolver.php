<?php

namespace Deck\Router;

/**
 * The short description
 *
 * As many lines of extendend description as you want {@link element}
 * links to an element
 * {@link http://www.example.com Example hyperlink inline link} links to
 * a website. The inline
 *
 * @package package name
 * @author  Pedro Koblitz
 */
final class PackageResolver implements ResolverInterface
{

    /*
     * @var
     */
    public $namespaces;

    /*
     * @var
     */
    public $packages;

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function __construct(array $namespaces, array $packages)
    {

        $this->namespaces = $namespaces;
        $this->packages = $packages;
    }

    public function check($resource)
    {
        if (!is_string($resource)) {
            throw new \InvalidArgumentException("Both arguments must be of type string.", 100);
        }

        if (!isset($this->packages[$resource])) {
            throw new \InvalidArgumentException("Package $resource is not set", 101);
        }

        $className = $this->packages[$resource];

        if (!is_string($className)) {
            throw new \InvalidArgumentException("Both arguments must be of type string.", 102);
        }
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    protected function resolve($resource)
    {
        $this->check($resource);

        $childIsSet = isset($this->namespaces['package.child']);
        $coreIsSet = isset($this->namespaces['package.core']);
        $className = $this->packages[$resource];

        if ($childIsSet) {
            $childClass = $this->namespaces['package.child'] . $className;
        }

        if ($coreIsSet) {
            $class = $this->namespaces['package.core'] . $className;
        }

        if (!$childIsSet && !$coreIsSet) {
            throw new \Exception("Error Processing Request", 103);
        }

        $isChild = isset($childClass) && class_exists($childClass);
        $isCore = isset($class) && class_exists($class);

        if ($isChild) {
            return $childClass;
        }

        if ($isCore) {
            return $class;
        }

        throw new \Exception("Error Processing Request", 104);
    }
}
