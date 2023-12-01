<?php
/**
 * SDK for the satellite API
 * custom autoloader, used for tests
 *
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
//  autoload
$baseDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$lib = $baseDir . "src" . DIRECTORY_SEPARATOR;
$exceptionDir = $lib . "Exception" . DIRECTORY_SEPARATOR;
$responseDir = $lib . "Response" . DIRECTORY_SEPARATOR;

foreach (glob($exceptionDir . "*.php") as $filename) {
    include $filename;
}

foreach (glob($lib . "*.php") as $filename) {
    include $filename;
}

foreach (glob($responseDir . "*.php") as $filename) {
    include $filename;
}
@include "vendor/autoload.php";
include "SDK.php";