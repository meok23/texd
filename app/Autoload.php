<?php

namespace app;

/**
 * 自动加载
 *
 * @author 煤老板 <meok23@sina.com>
 * @date   2018-02-26
 */
class Autoload
{
    public static function register()
    {
        spl_autoload_register(__CLASS__ . '::loader', true, false);
    }

    private static function loader($className)
    {
        $relative_class = rtrim($className, '\\');
        $file = ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
}
