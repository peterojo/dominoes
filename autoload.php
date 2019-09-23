<?php
function autoloadArtifact ($class) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $filename = __DIR__ . DIRECTORY_SEPARATOR . 'Artifact' . DIRECTORY_SEPARATOR . basename($classPath) . '.php';

    if (is_readable($filename)) {
        include_once $filename;
    }
}

spl_autoload_register('autoloadArtifact');