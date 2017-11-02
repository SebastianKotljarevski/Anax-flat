Revision history
=======================================



History for Anax
-----------------------------------

v2.5.28 (2017-10-18)

* Fix: CFileBasedContent generate toc with duplicate items.


v2.5.27 (2017-06-22)

* Fix warning in CFileBasedContent for PHP 7, need convert to integer.


v2.5.26 (2017-06-08)

* Enable markdown link to same page using ./.


v2.5.25 (2017-01-04)

* Use `ANAX_APP_PATH` for session name.


v2.5.24 (2016-11-28)

* Add method `CRequest::hasGet()`.


v2.5.23 (2016-11-15)

* Rework CThemeEngine to configure theme selector.


v2.5.22 (2016-11-14)

* Add backlink to content source in revision history.


v2.5.21 (2016-11-14)

* Correct theme engine to use added stylesheets and js.


v2.5.20 (2016-11-07)

* Cleanup debug info for urls with `!`.


v2.5.19 (2016-11-07)

* Treat relative urls, in documents in folder `content`, as assets when they are started with a `!`.


v2.5.18 (2016-10-31)

* Fix incoming url that has encoded characters.


v2.5.17 (2016-10-18)

* Fix mailto link using Markdown.


v2.5.16 (2016-10-18)

* Fix baseurl to relative image sources, use `asset()` to create url.


v2.5.15 (2016-10-18)

* Add baseurl to relative image sources.


v2.5.13 (2016-10-18)

* Fix `mailto:` links.


v2.5.12 (2016-10-14)

* Fix that author is displayed.


v2.5.11 (2016-09-12)

* Add `CThemeEngine::appendToVariable()`.
* Add `CSession::delete()` and `CSession::readOnce()`.


v2.5.10 (2016-09-12)

* Add info to default config for `config/content.php`.


v2.5.9 (2016-09-12)

* Add empty `config/routes/custom.php` to make it easy for users to add new routes.


v2.5.8 (2016-08-11)

* New empty template added.
* Added region for content after-main.


v2.5.7 (2016-08-10)

* Fix. Enable to work withouth reference to phpbb forum.


v2.5.6 (2016-08-10)

* Enable to work withouth reference to phpbb forum.


v2.5.5 (2016-07-04)

* Added menu.


v2.5.3 (2016-06-22)

* Update index view for design course kmom02 and new grid.


v2.5.2 (2016-06-08)

* Several edits and cleanups for Anax Flat and building flat websites with Anax.


v2.5.1 (2016-05-09)

* Several edits and cleanups for Anax Flat and building flat websites with Anax.


v2.5.0 (2015-09-02)

* Merged Anax MVC changes.
    * Enhancing verbosity on exception messages by printing out $di
    * Display valid routes and controllers to aid in 404 debugging.

* Cleaning up from Anax-MVC and removing stuff not to be in Anax.



History for Anax-MVC
-----------------------------------

v2.0.4 (2015-04-05)

* Navbar to display current item even if ? is present, fix 15.
* Updated composer.json and removed dependency to coverall.io.
* updated .travis.yml to remove dependency to coverall.io and do not install composer.phar.
* Adding example for shortcodes [BASEURL], [RELURL] and [ASSET].
* Adding example code on using forward and view creation, fix #13.
* `CDispatcherBasic->foward()` now returns a value, fix #12.
* Throw exception when headers already sent, fix #11.
* Removed testcase where exception was not thrown in creating session on hvm.



v2.0.3 (2015-01-12)

* Adding autoloader to composer.json to enable download from packagist using composer and require.
* Add PHP 5.6 as testenvironment in Travis.
* Testcases for \Anax\Session\CSession.
* Testcases for \Anax\DI\CDI.
* Improved exception when creation of service failes in $di.
* CNavbar now works for descendants of a menuitem.
* Correcting example `webroot/test/navigation-bar.php` to correctly show current menu item.
* Improved error messages in `CDispatcherbasic`.
* Improved errorhandling in trait `TInjectable`, now throwing more verbose exceptions on which class is using the trait.



v2.0.2 (2014-10-25)

* Added example for navigation bar and how to create urls in navbar.
* Add default route handler for route defined as '*'.
* Added empryt directory for app-specific file content `app/content`.
* Minor fixes to error messages.
* Several minor fixes to code formatting.
* Added `CUrl::createRelative()` for urls relative current frontcontroller.
* Reorganized and added testprograms in `webroot/test`.
* Improved documentation in `docs/documentation` and `webroot/docs.php`.
* Added config-file for phpunit `phpunit.xml.dist`.
* Added `phpdoc.dist.xml`.
* Enhanced `Anax\Navigation\CNavBar` with class in menu item.
* Added phpdocs to `docs/api`.



v2.0.1 (2014-10-17)

* Updates to match comments example.
* Introduced and corrected bug (issue #1) where exception was thrown instead of presenting a 404-page.
* Added `CSession::has()`.
* Corrected bug #2 in `CSession->name` which did not use the config-file for naming the session.
* Added `Anax\MVC\CDispatcherBasic` calling `initialize` om each controller.
* Added exception handling to provide views for 403, 404 and 500 http status codes and added example program in `webroot/error.php`.
* Added `docs` to init online documentation.
* Adding flash message (not storing in session).
* Adding testcases for CDispatcherBasic and now throwing exceptions from `dispatch()` as #3.
* Adding example for integrating CForm in Anax MVC and as a result some improvements to several places.
* Adding check to `Anax\MVC\CDispatcherBasic` to really check if the methods are part of the controller class and not using `__call()`.
* Improved error handling in `Anax\MVC\CDispatcherBasic` and testcase in `webroot/test_errormessages.php`.



v2.0.0 (2014-03-26)

* Cloned Anax-MVC and preparing to build Anax-MVC.
* Added autoloader for PSR-0.
* Not throwing exception in standard anax autoloader.
* Using anonomous functions in `bootstrap.php` to set up exception handler and autoloader.
* Added `$anax['style']` as inline style in `config.php` and `index.tpl.php`.
* Added unit testing with phpunit.
* Added automatic build with travis.
* Added codecoverage reports on coveralls.io.
* Added code quality through scrutinizer-ci.com.
* Major additions of classes to support a framework using dependency injections and service container.



History for Anax-base
-----------------------------------

v1.0.3 (2013-11-22)

* Naming of session in `webroot/config.php` allows only alphanumeric characters.


v1.0.2 (2013-09-23)

* Needs to define the ANAX_INSTALL path before using it. v1.0.1 did not work.


v1.0.1 (2013-09-19)

* `config.php`, including `bootstrap.php` before starting session, needs the autoloader()`.


v1.0.0 (2013-06-28)

* First release after initial article on Anax.



```
 .  
..:  Copyright (c) 2013 - 2015 Mikael Roos, mos@dbwebb.se
```
