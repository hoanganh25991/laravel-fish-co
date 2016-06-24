<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);


// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.

/** ONLY apply for rightfrom.us server to find-out truth path of file */
/*
 * $uri = /fishco/upload/example.png
 * logic check: file_exists(__DIR__.'/public'.$uri)
 * __DIR__.'/public'.$uri = "/var/www/html/fishco/public[/fishco]upload/example.png
 * WRONG at [/fishco]
 * get out /fishco from $uri
 */
$uri = str_replace("/fishco", "", $uri);
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
