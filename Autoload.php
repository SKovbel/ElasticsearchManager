<?php

/**
 * Autoload class
 *
 */
class Autoload
{
    /**
     * 自动加载文件
     *
     * @param string $className
     */
    public static function load($className)
    {
        $classFileName = str_replace('\\', '/', $className) . '.php';
        if (file_exists($classFileName) && is_file($classFileName) && is_readable($classFileName)) {
            require_once $classFileName;
        }
    }

    /**
     * 注册自动加载函数
     *
     */
    public static function register()
    {
        spl_autoload_register([self, 'load'], true, true);
    }
}
