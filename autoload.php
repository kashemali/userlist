<?php
/*
* @Package: autoload
*/

declare(strict_types=1);
spl_autoload_register(function (string $className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once dirname(__FILE__) . '/' . $className . '.php';
});
