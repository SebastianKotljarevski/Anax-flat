<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    "callback" => function ($url) {
        if ($url == $this->di->get("request")->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting "mark-if-parent" set to true.
     *
     */
    "is_parent" => function ($parent) {
        $route = $this->di->get("request")->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    "create_url" => function ($url) {
        return $this->di->get("url")->create($url);
    },
    */



    // Name of this menu
    "navbarTop" => [
        // Use for styling the menu
        "wrapper" => null,
        "class" => "rm-default rm-desktop",
     
        // Here comes the menu strcture
        "items" => [

            "blogg" => [
                "text"  =>"<i class=\"icon fa fa-book\"></i> Blogg",
                "url"   => $this->di->get("url")->create("blogg"),
                "title" => "Läs om dbwebb, kurserna, webbprogrammering och webbutveckling och utbildning i allmänhet"
            ],

            "kunskap" => [
                "text"  =>"<i class=\"icon fa fa-book\"></i> Kunskap",
                "url"   => $this->di->get("url")->create("kunskap"),
                "title" => "Läs kunskapsartiklar"
            ],

            "coachen" => [
                "text"  =>"<i class=\"icon fa fa-book\"></i> Coachen",
                "url"   => $this->di->get("url")->create("coachen"),
                "title" => "Läs tips från coachen"
            ],

            "uppgifter" => [
                "text"  =>"<i class=\"icon fa fa-book\"></i> Uppgifter",
                "url"   => $this->di->get("url")->create("uppgift"),
                "title" => "Jobba med uppgifter och övningar"
            ],
        ],
    ],



    // Name of this menu
    "navbarMax" => [
        // Use for styling the menu
        "id" => "rm-menu",
        "wrapper" => null,
        "class" => "rm-default rm-mobile",
     
        // Here comes the menu strcture
        "items" => [

            "blogg" => [
                "text"  =>"Blogg",
                "url"   => $this->di->get("url")->create("blogg"),
                "title" => "Läs om dbwebb, kurserna, webbprogrammering och webbutveckling och utbildning i allmänhet"
            ],

            "kunskap" => [
                "text"  =>"Kunskapsbanken",
                "url"   => $this->di->get("url")->create("kunskap"),
                "title" => "Läs kunskapsartiklar"
            ],

            "coachen" => [
                "text"  =>"Tips från Coachen",
                "url"   => $this->di->get("url")->create("coachen"),
                "title" => "Läs tips från coachen"
            ],

            "uppgifter" => [
                "text"  =>"Uppgiftsbanken",
                "url"   => $this->di->get("url")->create("uppgift"),
                "title" => "Jobba med uppgifter och övningar"
            ],
        ],
    ]
];
