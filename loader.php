<?php

if (!function_exists('sprint_loader')) {
    function sprint_loader($className)
    {
        $includeNamespace = 'Sprint\\Migration';
        $includePath = __DIR__ . '/classes';

        if ($includeNamespace . '\\' === substr($className, 0, strlen($includeNamespace . '\\'))) {
            $fileName = '';
            if (false !== ($lastNsPos = strripos($className, '\\'))) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

            $fileName = ($includePath !== null ? $includePath . DIRECTORY_SEPARATOR : '') . $fileName;
            if (is_readable($fileName)) {
                /** @noinspection PhpIncludeInspection */
                require $fileName;
            }
        }
    }

    spl_autoload_register('sprint_loader');
}
