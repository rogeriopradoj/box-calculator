<?php

ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set('UTC');

// root of package
$composerAutoloadPackage = realpath(dirname(__FILE__) . '/../vendor/autoload.php');
// root of a system using this package
$composerAutoloadSystem  = realpath(dirname(__FILE__) .  '/../../../autoload.php');

if (strnatcmp(phpversion(), '5.3') < 0 || !@include($composerAutoloadPackage)) {
    /* Include path */
    set_include_path(
        implode(
            PATH_SEPARATOR,
            array(
                dirname(__FILE__) . '/../src',
                get_include_path(),
            )
        )
    );

    /* PEAR autoloader */
    function bootstrapPearAutoloader($className)
    {
        $filename = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $path .= DIRECTORY_SEPARATOR . $filename;
            if (is_file($path)) {
                require_once $path;
                return true;
            }
        }
        return false;
    }
    spl_autoload_register('bootstrapPearAutoloader');

    // brute-force autoload
    $uberloader = realpath('vendor/rogeriopradoj/uberloader/uberloader.php');

    require_once $uberloader;
    Uberloader::init(dirname(__FILE__), dirname(__FILE__) . "/cache/");
}
