<?php
/**
 * Add routes to the router, processed in the same order they are added.
 * The variabel $app relates to $this.
 */



/**
 * Default route to load routes from /content
 */
$app->router->add("*", function () use ($app) {
    $content = $app->content->contentForRoute();
    foreach ($content->views as $view) {
        $app->views->add($view);
    }
    $app->theme->addFrontmatter($content->frontmatter);
});
