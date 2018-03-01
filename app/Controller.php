<?php

namespace app;

/**
 * 控制器
 *
 * @author 煤老板 <meok23@sina.com>
 * @date   2018-02-26
 */
class Controller
{
    /**
     * 视图渲染
     *
     * @param string $filename
     * @param array  $data
     */
    private function render($filename = '', $data = [])
    {
        extract($data);

        require ROOT_PATH . 'app/' . $filename . '.php';
    }

    /**
     * 文档展示
     */
    public function doc()
    {
        $r = !empty($_GET['r']) ? trim($_GET['r']) : 'README.md';
        $docRelativeDir = Conf::$all['doc_relative_dir'];
        $baseUrl = Conf::$all['base_url'];
        $filename = ROOT_PATH . $docRelativeDir . '/' . $r;

        $content = '';
        if (is_file($filename)) {
            // 文件过滤
            $postfix = strtolower(substr($filename, -3));
            if (in_array($postfix, ['jpg', 'png', 'gif'])) {
                $content = '![](' . $baseUrl . $docRelativeDir . '/' . $r . ')';
            } elseif ($postfix === '.md') {
                $content = file_get_contents($filename);

                // 本地插图路径重写
                $pattern = '/!\[\]\(\/(.+)\)/i';
                $replacement = '![](' . $baseUrl . $docRelativeDir . '/$1)';
                $content = preg_replace($pattern, $replacement, $content);
            }
        }

        $currentId = 'file_tree_' . explode('.', str_replace('/', '_', $r))[0];
        $this->render('view_doc', ['content' => $content, 'currentId' => $currentId]);
    }

    /**
     * 生成文档目录
     *
     * @return bool|int
     */
    public function buildNav()
    {
        // 生成导航目录树
        $m = new Model();
        $docRelativeDir = Conf::$all['doc_relative_dir'];
        $fileTree = $m->fileTree(ROOT_PATH . $docRelativeDir);

        return file_put_contents(ROOT_PATH . 'conf/index_nav.php', $fileTree);
    }
}
