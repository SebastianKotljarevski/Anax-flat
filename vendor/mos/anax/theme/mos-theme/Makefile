#!/usr/bin/make -f
#
#

#
# less
#
LESS 			= style.less
LESS_OPTIONS 	= --strict-imports --include-path=src/style/
FONT_AWESOME	= src/style/font-awesome/fonts/
TARGET_CSS		= ../../webroot/css/mos-theme.css
TARGET_FONT		= ../../webroot/fonts/

.PHONY: less-update
less-update: less

.PHONY: less
less:
	lessc $(LESS_OPTIONS) $(LESS) $(TARGET_CSS)
	#lessc --clean-css $(LESS_OPTIONS) $(LESS) build/css/style.min.css
	#cp build/css/style.css htdocs/css/style.css
	#cp build/css/style.min.css htdocs/css/style.min.css
	
	rsync -av $(FONT_AWESOME) $(TARGET_FONT)

.PHONY: lint
lint: less
	lessc --lint $(LESS) > build/lint/style.less
	- csslint build/css/style.css > build/lint/style.css
	ls -l build/lint/
