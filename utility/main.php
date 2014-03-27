<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$uri = $_SERVER['REQUEST_URI'];
$dirs = explode('/', $uri);
date_default_timezone_set('UTC');
?>