<?php

namespace app;

/**
 * 路由类
 *
 * @author 煤老板 <meok23@sina.com>
 * @date   2018-02-27
 */
class Route
{
    /**
     * 程序执行入口
     */
    public function entry()
    {
        $method = $this->urlAnalyse();

        $con = new Controller();
        call_user_func([$con, $method]);
    }

    /**
     * url分析
     */
    private function urlAnalyse()
    {
        $r = !empty($_GET['r']) ? trim($_GET['r']) : '';

        // 获取访问的方法名
        if ($len = strpos($r, '/')) {
            $method = substr($r, 0, $len);
        } else {
            $method = Conf::$all['default_method'];
        }

        // 提取url参数
        $_GET['r'] = substr($r, $len + 1);
        $this->queryExtract($_GET['r']);

        return $method;
    }

    /**
     * url参数提取
     *
     * @param $r
     */
    private function queryExtract($r)
    {
        $queries = explode('/', trim($r, "/"));
        $len = count($queries);

        for ($i = 0; $i < $len; $i += 2) {
            $currentVal = isset($queries[$i + 1]) ? $queries[$i + 1] : '';
            $_GET[$queries[$i]] = $currentVal;
        }
    }

    /**
     * url生成
     *
     * @param string $query
     * @return string
     */
    public static function urlC($query)
    {
        $baseUrl = Conf::$all['base_url'];

        if (Conf::$all['is_rewrite']) {
            return $baseUrl . $query;
        } else {
            return $baseUrl . 'index.php?r=' . $query;
        }
    }
}
