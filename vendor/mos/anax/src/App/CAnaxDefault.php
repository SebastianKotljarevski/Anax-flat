<?php

namespace Anax\App;

/**
 * Anax base class for an application.
 *
 */
class CAnaxDefault
{
    use \Anax\DI\TInjectable,
        \Anax\TConfigure,
        \Anax\TLoadFile;



    /**
     * Construct.
     *
     * @param array $di dependency injection of service container.
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->configure("app.php");
    }



    /**
     * Load routes from files.
     *
     * @param array $di dependency injection of service container.
     *
     * @return $this for chaining.
     */
    public function loadRoutes()
    {
        $routeFiles = $this->config["routeFiles"];
        foreach ($routeFiles as $file) {
            $this->loadFile($file, ["app" => $this]);
        }
        return $this;
    }
}
