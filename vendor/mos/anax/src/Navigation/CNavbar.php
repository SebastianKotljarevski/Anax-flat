<?php

namespace Anax\Navigation;

/**
 * Helper to create a navbar for sites by reading its configuration from file
 * and then applying some code while rendering the resultning navbar.
 *
 */
class CNavbar
{
    use \Anax\TConfigure,
        \Anax\DI\TInjectionAware;



    /**
     * Create a navigation bar / menu, with submenu.
     *
     * @param: string $menuName name of menu config to use.
     *
     * @return string with html for the menu.
     *
     * @link http://dbwebb.se/coachen/skapa-en-dynamisk-navbar-meny-med-undermeny-via-php
     */
    public function create($menuName = null)
    {
        // Keep default options in an array and merge with incoming options that can override the defaults.
        $default = array(
            "id"          => null,
            "class"       => null,
            "wrapper"     => "nav",
            "create_url"  => function ($url) {
                return $url;
            },
        );
        $menu = array_replace_recursive($default, $this->config);
        if (!is_null($menuName)) {
            $menu = array_replace_recursive($menu, $this->config[$menuName]);
        }

        // Create the ul li menu from the array, use an anonomous recursive
        // function that returns an array of values.
        $createMenu = function (
            $items,
            $callback,
            $ulId = null,
            $ulClass = null
        ) use (
            &$createMenu,
            $menu
        ) {

            $html = null;
            $hasItemIsSelected = false;

            foreach ($items as $item) {
                // has submenu, call recursivly and keep track on if the submenu has a selected item in it.
                $subMenu        = null;
                $subMenuButton  = null;
                $subMenuClass   = null;
                $selectedParent = null;

                if (isset($item["submenu"])) {
                    list($subMenu, $selectedParent) = $createMenu($item["submenu"]["items"], $callback);
                    $selectedParent = $selectedParent
                        ? "selected-parent "
                        : null;
                    $subMenuButton = "<a class=\"rm-submenu-button\" href=\"#\"></a>";
                    $subMenuClass = "rm-submenu";
                }

                // Check if the current menuitem is selected
                $selected = $callback($item["url"])
                    ? "selected "
                    : null;

                // Check if the menuitem is a parent of current page, /controller for /controller/action
                $isParent = null;
                if (isset($item["mark-if-parent"]) && $item["mark-if-parent"] == true) {
                    $isParent = $menu["is_parent"]($item["url"])
                        ? "selected-parent "
                        : null;
                }

                // Is there a class set for this item, then use it
                $class = isset($item["class"]) && ! is_null($item["class"])
                    ? $item["class"]
                    : null;

                // Prepare the class-attribute, if used
                $class = ($selected || $selectedParent || $isParent || $class)
                    ? " class=\"{$selected}{$selectedParent}{$isParent}{$class}{$subMenuClass}\" "
                    : null;

                // Add the menu item
                $url = $menu["create_url"]($item["url"]);
                $html .= "\n<li{$class}>{$subMenuButton}<a href='{$url}' title='{$item['title']}'>{$item['text']}</a>{$subMenu}</li>\n";

                // To remember there is selected children when going up the menu hierarchy
                if ($selected) {
                    $hasItemIsSelected = true;
                }
            }

            // Return the menu
            return array("\n<ul$ulId$ulClass>$html</ul>\n", $hasItemIsSelected);
        };

        // Call the anonomous function to create the menu, and submenues if any.
        $id = isset($menu["id"])
            ? " id=\"{$menu["id"]}\""
            : null;
        $class = isset($menu["class"])
            ? " class=\"{$menu["class"]}\""
            : null;

        list($html) = $createMenu(
            $menu["items"],
            $menu["callback"],
            $id,
            $class
        );

        // Set the id & class element, only if it exists in the menu-array
        $wrapper = $menu["wrapper"];
        if ($wrapper) {
            $html = "<{$wrapper}>{$html}</{$wrapper}>";
        }

        return "\n{$html}\n";
    }
}
