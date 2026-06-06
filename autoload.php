<?php

spl_autoload_register(function ($class) {

    $directories = [
        __DIR__ . '/Models/',
        __DIR__ . '/Controllers/',
        __DIR__ . '/Services/',
        __DIR__ . '/Utils/',
        __DIR__ . '/Repositories/',

    ];

    foreach ($directories as $directory) {

        $file = $directory . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
