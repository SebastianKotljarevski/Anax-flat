<?php

namespace Anax\View;

/**
 * A view container, store all views per region, render at will.
 *
 */
class CViewContainer implements \Anax\DI\IInjectionAware
{
    use \Anax\TConfigure,
        \Anax\DI\TInjectionAware;



    /**
     * Properties
     *
     */
    private $views = []; // Array for all views



    /**
     * Convert template to path to template file.
     *
     * @param string $template the name of the template file to include
     *
     * @throws Anax\View\Exception when template file is missing
     *
     * @return string as path to the template file
     */
    public function getTemplateFile($template)
    {
        $paths  = $this->config["path"];
        $suffix = $this->config["suffix"];

        foreach ($paths as $path) {
            $file = $path . "/" . $template . $suffix;
            if (is_file($file)) {
                return $file;
            }
        }

        throw new Exception("Could not find template file '$template'.");
    }



    /**
     * Add a view to be included as a template file.
     *
     * @param string $template the name of the template file to include
     * @param array  $data     variables to make available to the view, default is empty
     * @param string $region   which region to attach the view
     * @param int    $sort     which order to display the views
     *
     * @return $this
     */
    public function add($template, $data = [], $region = "main", $sort = 0)
    {
        if (empty($template)) {
            return $this;
        }

        $view = $this->di->get("view");

        if (is_string($template)) {
            $tpl = $this->getTemplateFile($template);
            $type = "file";
        } elseif (is_array($template)) {
            // Can be array with complete view or array with callback
            $tpl = $template;
            $type = null;
            $region = isset($tpl["region"])
                ? $tpl["region"]
                : $region;

            if (isset($tpl["callback"])) {
                // Need to test the callback!
                $tpl["template"] = $template;
                $tpl["type"] = "callback";
            } elseif (isset($tpl["template"])) {
                if (!isset($tpl["type"]) || $tpl["type"] === "file") {
                    $tpl["type"] = "file";
                    $tpl["template"] = $this->getTemplateFile($tpl["template"]);
                }
            }
        }

        $view->set($tpl, $data, $sort, $type);
        $view->setDI($this->di);
        $this->views[$region][] = $view;

        return $this;
    }



    /**
     * Add a callback to be rendered as a view.
     *
     * @param string $callback function to call to get the content of the view
     * @param array  $data     variables to make available to the view, default is empty
     * @param string $region   which region to attach the view
     * @param int    $sort     which order to display the views
     *
     * @return $this
     */
    public function addCallback($callback, $data = [], $region = "main", $sort = 0)
    {
        $view = $this->di->get("view");
        $view->set(["callback" => $callback], $data, $sort, "callback");
        $view->setDI($this->di);
        $this->views[$region][] = $view;

        return $this;
    }



    /**
     * Add a string as a view.
     *
     * @param string $content the content
     * @param string $region  which region to attach the view
     * @param int    $sort    which order to display the views
     *
     * @return $this
     */
    public function addString($content, $region = "main", $sort = 0)
    {
        $view = $this->di->get("view");
        $view->set($content, [], $sort, "string");
        $view->setDI($this->di);
        $this->views[$region][] = $view;
        
        return $this;
    }



    /**
     * Check if a region has views to render.
     *
     * @param string $region which region to check
     *
     * @return $this
     */
    public function hasContent($region)
    {
        return isset($this->views[$region]);
    }



    /**
     * Render all views for a specific region.
     *
     * @param string $region which region to use
     *
     * @return $this
     */
    public function render($region = "main")
    {
        if (!isset($this->views[$region])) {
            return $this;
        }

        mergesort($this->views[$region], function ($a, $b) {
            $sa = $a->sortOrder();
            $sb = $b->sortOrder();

            if ($sa == $sb) {
                return 0;
            }

            return $sa < $sb ? -1 : 1;
        });

        foreach ($this->views[$region] as $view) {
            $view->render();
        }

        return $this;
    }
}
