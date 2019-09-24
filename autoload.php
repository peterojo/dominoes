<?php

spl_autoload_register(function($class) {
    $file = str_replace(['Dominos', '\\'], [__DIR__, DIRECTORY_SEPARATOR], $class) . '.php';

    if (is_readable($file)) {
        include_once $file;
    }
});