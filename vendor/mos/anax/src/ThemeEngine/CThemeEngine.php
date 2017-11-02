<?php

namespace Anax\ThemeEngine;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CThemeEngine implements IThemeEngine, \Anax\DI\IInjectionAware
{
    use \Anax\View\THelpers,
        \Anax\TConfigure,
        \Anax\DI\TInjectionAware;



    /**
     * Array with variables to provide to theme template files.
     */
    protected $data = [];



    /**
     * Overwrite template file as defined in config.
     */
    protected $template = null;



    /**
     * Set another template file to use.
     *
     * @param string $name of the template file.
     *
     * @return $this
     */
    public function setTemplate($name)
    {
        $this->template = $name;
        return $this;
    }



    /**
     * Shortcut to set title.
     *
     * @param string $value of the variable.
     *
     * @return $this
     */
    public function setTitle($value)
    {
        return $this->setVariable("title", $value);
    }



    /**
     * Set a base title which is appended to the page title.
     *
     * @param string $value of the variable.
     *
     * @return $this
     */
    public function setBaseTitle($value)
    {
        return $this->setVariable("title_append", $value);
    }



    /**
     * Set a variable which will be exposed to the template files during render.
     *
     * @param string $which variable to set value of.
     * @param mixed  $value of the variable.
     *
     * @return $this
     */
    public function setVariable($which, $value)
    {
        $this->data[$which] = $value;
        return $this;
    }



    /**
     * Append value to variable by making the variable an array.
     *
     * @param string $which variable to set value of.
     * @param mixed  $value of the variable.
     *
     * @return $this
     */
    public function appendToVariable($which, $value)
    {
        $this->data[$which][] = $value;
        return $this;
    }



    /**
     * Add frontmatter to be exposed to theme template file.
     *
     * @param array|null $matter to add.
     *
     * @return $this
     */
    public function addFrontmatter($matter)
    {
        $this->data = array_merge($this->data, $matter);
        return $this;
    }



    /**
     * Get a value of a variable which will be exposed to the template files
     * during render.
     *
     * @param string $which variable to get value of.
     *
     * @return mixed as value of variable, or null if value is not set.
     */
    public function getVariable($which)
    {
        if (isset($this->data[$which])) {
            return $this->data[$which];
        } elseif (isset($this->config["data"])) {
            return $this->config["data"][$which];
        }

        return null;
    }



    /**
     * Add a stylesheet.
     *
     * @param string $uri to add.
     *
     * @return $this
     */
    public function addStylesheet($uri)
    {
        $this->config["view"]["data"]["stylesheets"][] = $uri;
        return $this;
    }



    /**
     * Add a javascript asset.
     *
     * @param string $uri to add.
     *
     * @return $this
     */
    public function addJavaScript($uri)
    {
        $this->config["view"]["data"]["javascript_include"][] = $uri;
        return $this;
    }



    /**
     * Set/clear a key/value from the configuration file.
     *
     * @param string $uri to add.
     *
     * @return $this
     */
    public function setConfigKey($key, $value)
    {
        $this->config["view"]["data"][$key] = $value;
        return $this;
    }



    /**
     * Render the theme by applying the variables onto the template files.
     *
     * @return void
     */
    public function render()
    {
        // Create views for regions, from config-file
        if (isset($this->config["views"])) {
            foreach ($this->config["views"] as $view) {
                $this->di->views->add($view);
            }
        }

        // Get default view to start render from
        $defaultData = [
            "currentRoute" => "route-" . str_replace("/", "-", $this->di->get("request")->getRoute()),
        ];
        $view = $this->config["view"];

        $view["data"] = array_merge_recursive($defaultData, $this->data, $view["data"]);

        if (isset($this->template)) {
            $view["template"] = $this->template;
        }

        // Get the path to the view template file
        $view["template"] = $this->di->get("views")->getTemplateFile($view["template"]);

        // Send response headers, if any.
        $this->di->get("response")->sendHeaders();

        // Execute the default view
        $start = $this->di->get("view");
        $start->setDI($this->di);
        $start->set($view);
        $start->render();
    }
}
