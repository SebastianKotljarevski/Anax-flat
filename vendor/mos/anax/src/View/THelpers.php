<?php

namespace Anax\View;

/**
 * Trait with view helpers, provided by the ThemeEngine to the views.
 *
 */
trait THelpers
{
    /**
     * Render a view with an optional data set of variables.
     *
     * @param string $template the template file, or array
     * @param array  $data     variables to make available to the
     *                         view, default is empty
     *
     * @return void
     */
    public function renderView($template, $data = [])
    {
        $template = $this->di->get("views")->getTemplateFile($template);
        $view = $this->di->get("view");
        $view->setDI($this->di);
        $view->set($template, $data);
        $view->render();
    }



    /**
     * Create a class attribute from a string or array.
     *
     * @param string|array $args variable amount of classlists.
     *
     * @return string as complete class attribute
     */
    public function classList(...$args)
    {
        $classes = [];

        foreach ($args as $arg) {
            if (empty($arg)) {
                continue;
            } elseif (is_string($arg)) {
                $arg = explode(" ", $arg);
            }
            $classes = array_merge($classes, $arg);
        }

        return "class=\"" . implode(" ", $classes) . "\"";
    }



    /**
     * Create an url for a static asset.
     *
     * @param string $uri part of uri to use when creating an url.
     *
     * @return string as resulting url.
     */
    public function asset($uri = null)
    {
        return $this->di->get("url")->asset($uri);
    }



    /**
     * Create an url and prepending the baseUrl.
     *
     * @param string $uri part of uri to use when creating an url. "" or null
     *                    means baseurl to current frontcontroller.
     *
     * @return string as resulting url.
     */
    public function url($uri = null)
    {
        return $this->di->get("url")->create($uri);
    }



    /**
     * Get current url, without querystring.
     *
     * @return string as resulting url.
     */
    public function currentUrl()
    {
        return $this->di->get("request")->getCurrentUrl(false);
    }



    /**
     * Check if the region in the view container has views to render.
     *
     * @param string $region to check
     *
     * @return boolean true or false
     */
    public function regionHasContent($region)
    {
        return $this->di->get("views")->hasContent($region);
    }



    /**
     * Render views, from the view container, in the region.
     *
     * @param string $region to render in
     *
     * @return boolean true or false
     */
    public function renderRegion($region)
    {
        $this->di->get("views")->render($region);
    }



    /**
     * Load content from a route and return details to view.
     *
     * @param string $route to load content from.
     *
     * @return array with values to extract in view.
     */
    public function getContentForRoute($route)
    {
        $content = $this->di->get("content")->contentForInternalRoute($route);
        return $content->views["main"]["data"];
    }



    /**
     * Wrap a HTML element with start and end.
     *
     * @param string  $text  with content
     * @param string  $tag   HTML tag to search for
     * @param string  $start wrap start part
     * @param string  $end   wrap end part
     * @param number  $count hits to search for
     *
     * @return array with values to extract in view.
     */
    public function wrapElementWithStartEnd($text, $tag, $start, $end, $count)
    {
        return $this->di->get("textFilter")->wrapElementWithStartEnd($text, $tag, $start, $end, $count);
    }



    /**
     * Wrap content of a HTML element with start and end.
     *
     * @param string  $text  with content
     * @param string  $tag   HTML tag to search for
     * @param string  $start wrap start part
     * @param string  $end   wrap end part
     * @param number  $count hits to search for
     *
     * @return array with values to extract in view.
     */
    public function wrapElementContentWithStartEnd($text, $tag, $start, $end, $count)
    {
        return $this->di->get("textFilter")->wrapElementContentWithStartEnd($text, $tag, $start, $end, $count);
    }



    /**
     * Extrat the publish or update date for the article.
     *
     * @param array $dates a collection of possible date values.
     *
     * @return array with values for showing the date.
     */
    public function getPublishedDate($dates)
    {
        $defaults = [
            "revision" => [],
            "published" => null,
            "updated" => null,
            "created" => null,
        ];
        $dates = array_merge($defaults, $dates);
        
        if ($dates["revision"]) {
            return [t("Latest revision"), key($dates["revision"])];
        } elseif ($dates["published"]) {
            return [t("Published"), $dates["published"]];
        } elseif ($dates["updated"]) {
            return [t("Updated"), $dates["updated"]];
        } elseif ($dates["created"]) {
            return [t("Created"), $dates["created"]];
        }

        return [t("Missing pubdate."), null];
    }
}
