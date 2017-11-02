<?php
include(__DIR__.'/../vendor/autoload.php');


// Prepare the content
$text = <<<EOD
Typography using SmartyPants
=================================

This is an example on typographical elements using SmartyPants.

| What          | Source    | SmartyPants |
|---------------|-----------|---------|
| Curly quotes  | \"curly\" | "curly" |
| Curly quotes  | \'curly\' | 'curly' |
| Em-dash       | \-\--     | ---     |
| En-dash       | \--       | --      |
| Ellipsis      | \...      | ...     |

EOD;



// Filter the content
$filter = new \Mos\TextFilter\CTextFilter();
$page = $filter->parse($text, ["jsonfrontmatter", "markdown"]);
?>

<!doctype html>
<meta charset="utf-8">
<style>
table {
    font-size: 2em;
    width: 100%;
}
th {
    text-align: left;
}
</style>
<title>Example on Mos\TextFilter</title>
<?= $page->text ?>
