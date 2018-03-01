<?php

namespace app;

/**
 * 配置类
 *
 * @author 煤老板 <meok23@sina.com>
 * @date   2018-02-27
 */
class Conf
{
    public static $all = [];

    private static $marks = [];

    /**
     * 加载配置文件
     *
     * @param array $files 要加载的文件
     */
    public static function load($files = ['common'])
    {
        foreach ($files as $f) {
            if (in_array($f, self::$marks)) {
                continue;
            }

            $conf = require ROOT_PATH . 'conf/' . $f . '.php';

            self::$all = array_merge(self::$all, $conf);
            array_push(self::$marks, $f);
        }
    }
}
