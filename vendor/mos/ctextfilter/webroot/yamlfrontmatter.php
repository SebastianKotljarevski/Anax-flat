<?php
include(__DIR__.'/../vendor/autoload.php');


// Prepare the content
$text = <<<EOD
---
title: Title of my article
lang: en
key1: value1
key2: This is a long sentence.

meta:
    charset: utf8
---
My Article
=================================

This is an example on writing text and adding a YAML frontmatter.

EOD;



// Filter the content
$filter = new \Mos\TextFilter\CTextFilter();
$page = $filter->parse($text, ["yamlfrontmatter", "markdown"]);
?>

<!doctype html>
<meta charset="utf-8">
<title>Example on Mos\TextFilter</title>
<pre><?php var_dump($page->frontmatter) ?></pre>
<hr>
<?= $page->text ?>
