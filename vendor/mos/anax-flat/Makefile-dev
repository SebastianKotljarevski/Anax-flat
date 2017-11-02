#!/usr/bin/make -f
#
# Build website with environment
#
#

# Detect OS
OS = $(shell uname -s)

# Defaults
ECHO = echo

# Make adjustments based on OS
# http://stackoverflow.com/questions/3466166/how-to-check-if-running-in-cygwin-mac-or-linux/27776822#27776822
ifneq (, $(findstring CYGWIN, $(OS)))
	ECHO = /bin/echo -e
endif

# Colors and helptext
NO_COLOR	= \033[0m
ACTION		= \033[32;01m
OK_COLOR	= \033[32;01m
ERROR_COLOR	= \033[31;01m
WARN_COLOR	= \033[33;01m

# Which makefile am I in?
WHERE-AM-I = $(CURDIR)/$(word $(words $(MAKEFILE_LIST)),$(MAKEFILE_LIST))
THIS_MAKEFILE := $(call WHERE-AM-I)

# Echo some nice helptext based on the target comment
HELPTEXT = $(ECHO) "$(ACTION)--->" `egrep "^\# target: $(1) " $(THIS_MAKEFILE) | sed "s/\# target: $(1)[ ]*-[ ]* / /g"` "$(NO_COLOR)"



# Theme
#LESS 		 = theme/style_anax-flat.less
#LESS_OPTIONS = --strict-imports --include-path=theme/mos-theme/style/
#FONT_AWESOME = theme/font-awesome/fonts/
LESS 		 = theme/style.less
LESS_OPTIONS = --strict-imports --include-path=theme/modules/
NPMBIN       = theme/node_modules/.bin



# target: help                - Displays help.
.PHONY:  help
help:
	@$(call HELPTEXT,$@)
	@$(ECHO) "Usage:"
	@$(ECHO) " make [target] ..."
	@$(ECHO) "target:"
	@egrep "^# target:" $(THIS_MAKEFILE) | sed 's/# target: / /g'



# target: create-cache        - Create local cache dir.
.PHONY: create-cache
create-cache:
	@$(call HELPTEXT,$@)

	@$(ECHO) "$(ACTION)Create the directory for the cache items$(NO_COLOR)"
	install --directory --mode 777 cache/cimage cache/anax



# target: dev-env             - Create local dev environment.
.PHONY: dev-env
dev-env: create-cache
	@$(call HELPTEXT,$@)

	composer update
