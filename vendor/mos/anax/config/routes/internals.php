<?php
/**
 * Add routes to the router, processed in the same order they are added.
 * The variabel $app relates to $this.
 */



/**
 * Internal route for handling 403
 */
$app->router->addInternal("403", function () use ($app) {
    $app->dispatcher->forward([
        "controller"   => "error",
        "action"       => "statusCode",
        "params"       => [
            "code"     => 403,
            "message"  => "HTTP Status Code 403: This is a forbidden route.",
        ],
    ]);
})->setName("403");



/**
 * Internal route for handling 404
 */
$app->router->addInternal("404", function () use ($app) {
    $app->dispatcher->forward([
        "controller"   => "error",
        "action"       => "statusCode",
        "params"       => [
            "code"     => 404,
            "message"  => "HTTP Status Code 404: This route is not found.",
        ],
    ]);

    $app->dispatcher->forward([
        "controller"   => "error",
        "action"       => "displayValidRoutes",
    ]);
})->setName("404");



/**
 * Internal route for handling 500
 */
$app->router->addInternal("500", function () {
    $app->dispatcher->forward([
        "controller"   => "error",
        "action"       => "statusCode",
        "params"       => [
            "code"     => 500,
            "message"  => "HTTP Status Code 500: There was an internal server or processing error.",
        ],
    ]);
 })->setName("500");
