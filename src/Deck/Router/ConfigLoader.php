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
final class ConfigLoader
{
    const DECK_SETTINGS_PATH = "";

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    private function loadRouting()
    {
        $file = self::DECK_SETTINGS_PATH . '/routing.json';
        $string = file_get_contents($file);
        $json = json_decode($string, true);
        return $json;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    private function loadSettings()
    {
        $file = self::DECK_SETTINGS_PATH . '/settings.json';
        $string = file_get_contents($file);
        $json = json_decode($string, true);
        return $json;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function load()
    {
        $routing = $this->loadRouting();
        $settings = $this->loadSettings();
        return array('routing' => $routing, 'settings' => $settings);
    }
}
