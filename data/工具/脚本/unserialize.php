#!/usr/bin/php
<?php

/**
 * 提示用户输入，类似Python
 */

$fs     = true;
$output = '';

do {
    if ($fs) {
        fwrite(STDOUT, '请输入原始序列化字符串：');
        $fs = false;
    } else {
        fwrite(STDOUT, '抱歉，输入不能为空，请重新输入：');
    }

    $output = trim(fgets(STDIN));

} while (empty($output));

echo PHP_EOL . '解析后如下：' . PHP_EOL . PHP_EOL;

$ret = unserialize($output);

var_export($ret);
echo PHP_EOL;
