<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $className = basename(str_replace('\\', '/', $class));

    $file = __DIR__ . '/src/Model/' . $className . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});
