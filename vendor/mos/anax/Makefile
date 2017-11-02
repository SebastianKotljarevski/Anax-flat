#!/usr/bin/make -f
#
#

# ------------------------------------------------------------------------
#
# General and combined targets
#

# target: all - Default target, run tests and build
.PHONY:  all
all: test build


# target: test - Do all tests
.PHONY:  prepare test
#test: js-cs js-hint less-lint html-lint
test: phpunit phpcs phpmd



# target: build - Do all build
.PHONY:  build
build: test doc #less-compile less-minify js-minify



# target: doc - Generate documentation.
.PHONY:  doc
doc: phpdoc



# target: prepare - Prepare for tests and build
.PHONY:  prepare
prepare:
	[ -d build ] || mkdir build
	rm -rf build/*



# target: update - Update the codebase.
.PHONY:  update
update:
	git pull
	composer update



# target: clean - Removes generated files and directories.
.PHONY:  clean
clean:
	@echo "Target clean not implemented."
	#rm -f $(CSS_MINIFIED) $(JS_MINIFIED)



# target: help - Displays help.
.PHONY:  help
help:
	@echo "make [target] ..."
	@echo "target:"
	@egrep "^# target:" Makefile | sed 's/# target: / /g'



# target: cache - Create the cache directory.
.PHONY: cache
cache:
	mkdir app/cache
	chmod 777 app/cache



# ------------------------------------------------------------------------
#
# PHP
#

# target: phpcs - Codestyle for PHP.
.PHONY: phpcs

phpcs: prepare
	@echo "==> PHP Codestyle"
	phpcs --standard=.phpcs.xml | tee build/phpcs



# target: phpcbf - Fix codestyle for PHP.
.PHONY: phpcbf

phpcbf:
	@echo "==> PHP fix codestyle"
	phpcbf --standard=.phpcs.xml



# target: phpmd - Mess detector for PHP.
.PHONY: phpmd

phpmd: prepare
	@echo "==> PHP Mess detector"
	- phpmd . text .phpmd.xml | tee build/phpmd


# target: phpunit - Run unit tests for PHP.
.PHONY: phpunit

phpunit: prepare
	@echo "==> PHP unittests"
	phpunit --configuration .phpunit.xml



# target: phpdoc - Create documentation for PHP.
.PHONY: phpdoc

phpdoc:
	@echo "==> Building documentation"
	phpdoc --config=.phpdoc.xml



# =================== REVISE BELOW ====================0

#
# less
#
.PHONY: less

less:
	lessc --clean-css app/css/style.less htdocs/css/style.css
