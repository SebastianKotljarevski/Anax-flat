<?php
// Where did we install anax-flat? (without ending slash)
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));

// Where did we install anax? (without ending slash)
define("ANAX_APP_PATH", ANAX_INSTALL_PATH . "/app");

// We need the autoloader to start with
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Lets create a $di service container and inject it to our $app
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);

// The routes are defined in a separate file
$routes = ANAX_INSTALL_PATH . "/config/routes.php";
if (is_file(ANAX_APP_PATH . "/config/routes.php")) {
    $routes = ANAX_APP_PATH . "/config/routes.php";
}
require $routes;

// Lets check if the current request matches a route and if so
// render a response.
$app->router->handle();
$app->theme->render();
