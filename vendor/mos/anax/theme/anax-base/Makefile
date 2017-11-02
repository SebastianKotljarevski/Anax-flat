#!/usr/bin/make -f
#
#

# ------------------------------------------------------------------------
#
# The fileset
#
LESS_FILES 		= style/anax-base.less
LESS_ALL_FILES	= $(filter-out $(LESS_FILES), $(wildcard style/*.less))
LESS_COMPILED 	= $(LESS_FILES:.less=.css)
LESS_MINIFIED 	= $(LESS_FILES:.less=.min.css)



#
# Tool to compile and minify less code
#
LESS_COMPILE			= lessc
LESS_COMPILE_OPTIONS 	= 

LESS_MINIFY				= $(LESS_COMPILE)
LESS_MINIFY_OPTIONS 	= --clean-css

LESS_LINT				= $(LESS_COMPILE)
LESS_LINT_OPTIONS 		= --lint



# ------------------------------------------------------------------------
#
# Install files
#

# Where to install files
INSTALL_CSS_DIR		 = ../../webroot/css
INSTALL_CSS_FILES 	 = $(INSTALL_CSS_DIR)/$(notdir $(LESS_COMPILED))
INSTALL_CSS_MINIFIED = $(INSTALL_CSS_DIR)/$(notdir $(LESS_MINIFIED))



# ------------------------------------------------------------------------
#
# General and combined targets
#

# target: all - Default target, run tests and build
all: test build install



# target: build - Do all build
build: less-compile less-minify



# target: test - Do all tests
test: less-lint



# target: clean - Removes generated files and directories.
clean:
	@echo "Cleaning up."
	rm -f $(LESS_COMPILED) $(LESS_MINIFIED)



# target: help - Displays help.
help:
	@echo "make [target] ..."
	@echo "target:"
	@egrep "^# target:" Makefile | sed "s/# target: / /g"



# target: install - Copy files to install directory
install: $(INSTALL_CSS_FILES) $(INSTALL_CSS_MINIFIED)

$(INSTALL_CSS_FILES): $(LESS_COMPILED)
	@echo "==> Installing to $@"
	cp $< $@

$(INSTALL_CSS_MINIFIED): $(LESS_MINIFIED)
	@echo "==> Installing to $@"
	cp $< $@





# ------------------------------------------------------------------------
#
# LESS
#
$(LESS_COMPILED): 	$(LESS_ALL_FILES)
$(LESS_MINIFIED): 	$(LESS_COMPILED)

# target: less-compile - Compile LESS to CSS
less-compile: $(LESS_FILES)

%.css: %.less
	@echo "==> LESS compiling $<"
	$(LESS_COMPILE) $(LESS_COMPILE_OPTIONS) $< $@ 



# target: less-minify - Minify LESS files to min.css
less-minify: $(LESS_FILES)

%.min.css: %.less
	@echo "==> LESS minifying $<"
	$(LESS_MINIFY) $(LESS_MINIFY_OPTIONS) $< $@



# target: less-lint - Lint LESS files
.PHONY: less-lint

less-lint:
	@for file in $(LESS_ALL_FILES) $(LESS_FILES); do \
		echo "==> LESS linting $$file"; \
		$(LESS_LINT) $(LESS_LINT_OPTIONS) $$file; \
	done
