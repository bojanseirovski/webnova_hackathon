<?php

//  autoload
$baseDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$lib = $baseDir . "src" . DIRECTORY_SEPARATOR;
$exceptionDir = $lib . "Exception" . DIRECTORY_SEPARATOR;

foreach (glob($baseDir . "*.php") as $filename) {
    include $filename;
}

foreach (glob($exceptionDir . "*.php") as $filename) {
    include $filename;
}

foreach (glob($lib . "*.php") as $filename) {
    include $filename;
}