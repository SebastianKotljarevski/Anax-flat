<?php
/**
 * Config-file for page content.
 *
 */
return [

    // Use for styling the menu
    'basepath' => ANAX_APP_PATH . '/content',

    // Default options for textfilter
    'textfilter' => 'shortcode, markdown',

    // Default view
    'view' => 'default/article',

    // Filter to load content
    'pattern' => '*_*.md',

];
