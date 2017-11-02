<?php

namespace Anax\DI;

/**
 * Anax base class implementing Dependency Injection / Service Locator
 * of the services used by the framework, using lazy loading.
 */
class CDIFactoryDefault extends CDI
{
    use \Anax\TLoadFile;



   /**
     * Construct.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->loadFile("error_reporting.php");

        $this->setShared("response", "\Anax\Response\CResponseBasic");
        $this->setShared("validate", "\Anax\Validate\CValidate");
        $this->setShared("flash", "\Anax\Flash\CFlashBasic");
        $this->setShared("textFilter", "\Mos\TextFilter\CTextFilter");

        $this->set("route", "\Anax\Route\CRouteBasic");
        $this->set("view", "\Anax\View\CView");

        $this->set("ErrorController", function () {
            $controller = new \Anax\MVC\ErrorController();
            $controller->setDI($this);
            return $controller;
        });

        $this->setShared("log", function () {
            $log = new \Anax\Log\CLogger();
            $log->setContext("development");
            return $log;
        });

        $this->setShared("cache", function () {
            $cache = new \Anax\Cache\CFileCache();
            $cache->configure("cache.php");
            return $cache;
        });

        $this->setShared("request", function () {
            $request = new \Anax\Request\CRequestBasic();
            $request->init();
            return $request;
        });

        $this->setShared("url", function () {
            $url = new \Anax\Url\CUrl();
            $url->configure("url.php");
            $url->setSiteUrl($this->request->getSiteUrl());
            $url->setBaseUrl($this->request->getBaseUrl());
            $url->setStaticSiteUrl($this->request->getSiteUrl());
            $url->setStaticBaseUrl($this->request->getBaseUrl());
            $url->setScriptName($this->request->getScriptName());
            $url->setDefaultsFromConfiguration();
            return $url;
        });

        $this->setShared("views", function () {
            $views = new \Anax\View\CViewContainer();
            $views->configure("views.php");
            $views->setDI($this);
            return $views;
        });

        $this->setShared("router", function () {
            
            $router = new \Anax\Route\CRouterBasic();
            $router->setDI($this);
            return $router;
        });

        $this->setShared("dispatcher", function () {
            $dispatcher = new \Anax\MVC\CDispatcherBasic();
            $dispatcher->setDI($this);
            return $dispatcher;
        });

        $this->setShared("session", function () {
            $session = new \Anax\Session\CSession();
            $session->configure("session.php");
            $session->name();
            $session->start();
            return $session;
        });

        $this->setShared("theme", function () {
            $themeEngine = new \Anax\ThemeEngine\CThemeEngine();
            $themeEngine->setDI($this);
            $themeEngine->configure("theme.php");
            return $themeEngine;
        });

        $this->setShared("navbar", function () {
            $navbar = new \Anax\Navigation\CNavbar();
            $navbar->setDI($this);
            $navbar->configure("navbar.php");
            return $navbar;
        });

        $this->set("fileContent", function () {
            $fc = new \Anax\Content\CFileContent();
            $fc->setDI($this);
            $fc->configure("file_content.php");
            return $fc;
        });

        $this->set("pageContent", function () {
            $pc = new \Anax\Content\CPageContent();
            $pc->setDI($this);
            $pc->configure("page_content.php");
            return $pc;
        });

        $this->setShared("content", function () {
            $content = new \Anax\Content\CFileBasedContent();
            $content->setDI($this);
            $content->configure("content.php");
            $content->setDefaultsFromConfiguration();
            return $content;
        });
    }
}
