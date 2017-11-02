<?php

namespace Anax;

/**
 * Trait implementing reading from config-file and storing options in
 * $this->config.
 *
 */
trait TConfigure
{

    /**
     * Properties
     *
     */
    private $config = [];  // Store all config as an array



    /**
     * Read configuration from file or array, if a file, first check in
     * ANAX_APP_PATH/config and then in ANAX_INSTALL_PATH/config.
     *
     * @param array/string $what is an array with key/value config options
     *                           or a file to be included which returns such
     *                           an array.
     *
     * @throws Exception when argument if not a filer nor an array.
     *
     * @return $this for chaining.
     */
    public function configure($what)
    {
        $anaxInstallPath = ANAX_INSTALL_PATH . "/config/$what";
        $anaxAppPath = ANAX_APP_PATH . "/config/$what";
        
        if (is_array($what)) {
            $options = $what;
        } elseif (is_readable($anaxAppPath)) {
            $options = require $anaxAppPath;
        } elseif (is_readable($anaxInstallPath)) {
            $options = require $anaxInstallPath;
        } else {
            throw new Exception("Configure item '$what' is not an array nor a readable file.");
        }

        $this->config = array_merge($this->config, $options);
        return $this->config;
    }
}
