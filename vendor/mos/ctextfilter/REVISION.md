History
===================================


v1.2.21 (2017-10-02)
-----------------------------------

* Add options to shortcode [YOUTUBE] for playlistm time, id and class.


v1.2.20 (2017-02-07)
-----------------------------------

* Fix regexp on how code sections are detected to deal with JavaScript template strings.


v1.2.19 (2016-11-28)
-----------------------------------

* Fix `wrapElementContentWithStartEnd()` produced stray `</a>`.


v1.2.18 (2016-11-24)
-----------------------------------

* Shortcode FIGURE, figcaption is now optional.


v1.2.17 (2016-11-14)
-----------------------------------

* Enable optional backlink to document source in revision history.


v1.2.16 (2016-10-31)
-----------------------------------

* Add support for YAML using `symfony/yaml` or `mustangostang/spyc` if missing `php5-yaml`.


v1.2.15 (2016-10-18)
-----------------------------------

* Add baseurl to relative image sources.


v1.2.14 (2016-10-14)
-----------------------------------

* Move from beta in michelf/php-smartypants.


v1.2.13 (2016-08-23)
-----------------------------------

* Fix syntaxHighlightJs with pure text to htmlentities.


v1.2.11 (2016-08-10)
-----------------------------------

* Use https for youtube videos.


v1.2.10 (2016-08-04)
-----------------------------------

* Added BOOK as shortcode.


v1.2.9 (2016-06-22)
-----------------------------------

* Removed Geshi as dependency.


v1.2.8 (2016-06-17)
-----------------------------------

* Added a PHP port of Higlight.js, `scrivo/highlight.php`, to replace Geshi.
* Added Geshi stylesheet.


v1.2.7 (2016-06-17)
-----------------------------------

* Add PHP SmartyPantsTypographer.
* Correcting error in example `webroot/jsonfrontmatter.php`.


v1.2.6 (2016-06-08)
-----------------------------------

* Avoid failure and error when missing php-yaml.


v1.2.5 (2016-05-09)
-----------------------------------

* Several updates for Anax Flat.
* Added toc for article based on HTML headers.
* Adding wrapElementWithStartEnd and wrapElementContentWithStartEnd.
* Prepared with features from Lydia.


v1.2.4 (2016-03-17)
-----------------------------------

* Added support for <!--more--> and <!--stop-->.


v1.2.3 (2016-03-12)
-----------------------------------

* Added support for GeSHi syntax highligthing of code.
* Fix title when both defined in frontmatter and titlefromh1.
* Title defined in frontmatter overwrites titlefromh1


v1.2.2 (2016-02-16)
-----------------------------------

* Add filter to get title from first occurence of `<H1>`.


v1.2.1 (2016-02-14)
-----------------------------------

* Fix Travis build file.


v1.2.0 (2016-02-14)
-----------------------------------

* Add support for HTMLPurifier, #1.
* Add support for YAML front matter.
* Add support for JSON front matter.
* Improved handling of filters and added new front end `parse()`, #3.
* Deprecated `doFilters()`.


v1.1.2 (2016-01-11)
-----------------------------------

* Support incoming filter string as array, #4.
* Always treat filter string as lowercase string, #6.


v1.1.1 (2015-09-09)
-----------------------------------

* Changing path to autoloader for composer.json.
* Changing version for phpmarkdown in composer.json to 1.5.x.
* Minor error in webroot/textfilter.php.
* Removing file `autoload.php` and using vendor/autoload.php instead.


v1.1.0 (2015-04-01)
-----------------------------------

* Moved from Anax-oophp and Anax-MVC into its own repo and onto packagist.
