<?php

namespace app;

/**
 * 模型
 *
 * @author 煤老板 <meok23@sina.com>
 * @date   2018-02-27
 */
class Model
{

    /**
     * @param string $directory 磁盘硬路径
     * @param string $query
     * @return string
     */
    public function fileTree($directory, $query = '')
    {
        $d = dir(rtrim($directory, '/'));
        $html = '';

        while ($file = $d->read()) {

            // 过滤掉这两个点，当前目录&上级目录
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            if ((is_dir($directory . '/' . $file))) {
                $html .= '<li><p><a class="tree-dir" href="javascript:;">' . $file . '</a></p>';
                $html .= $this->fileTree($directory . '/' . $file, $query . '/' . $file);
            } else {

                // 文件过滤
                $postfix = strtolower(substr($file, -3));
                if (!in_array($postfix, ['.md', 'jpg', 'png', 'gif'])) {
                    continue;
                }

                $url = Route::urlC('doc' . $query . '/' . $file, '/');
                $id = 'file_tree_' . str_replace('/', '_', ltrim($query, '/')) . '_' . explode('.', $file)[0];
                $html .= '<li><p><a class="tree-content" id="' . $id . '" href="' . $url . '">' . $file . '</a></p>';
            }
            $html = $html . '</li>';
        }
        $d->close();

        return $html ? '<ul>' . $html . '</ul>' : $html;
    }
}
