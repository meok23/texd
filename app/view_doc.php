<?php

use \app\Conf;

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title># 知行 ←_← 开发笔记</title>
    <link rel="icon" href="<?= Conf::$all['base_url'] ?>favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="<?= Conf::$all['base_url'] ?>asset/lib/normalize.css">
    <link rel="stylesheet" href="<?= Conf::$all['base_url'] ?>asset/style.css?<?= rand() ?>">

    <!--markdown样式-->
    <link rel="stylesheet" href="<?= Conf::$all['base_url'] ?>asset/lib/github-markdown.css">
    <link rel="stylesheet" href="<?= Conf::$all['base_url'] ?>asset/lib/prism/prism.css">

    <style>
        .markdown-body {
            visibility: hidden;
        }
    </style>
</head>
<body>

<nav>
    <div class="title">
        # 知行 ←_← 开发笔记
    </div>
    <div class="file_tree" id="file_tree">
        <?php require ROOT_PATH . 'conf/index_nav.php'; ?>
    </div>

    <div class="footer">
        <small>
            Copyright © 2017
            <a href="<?= Conf::$all['base_url'] ?>">eewak</a> |
            <a href="http://www.miitbeian.gov.cn" target="_blank">粤ICP备**00****号</a>
        </small>
    </div>
</nav>

<main>
    <article>
        <div class="markdown-body" id="markdown_code"><?= $content ?></div>
    </article>
</main>

<script src="<?= Conf::$all['base_url'] ?>asset/lib/jquery.js"></script>
<script src="<?= Conf::$all['base_url'] ?>asset/script.js"></script>
<script>

    $(function () {

        // 文本内容渲染
        var markdownCode = $('#markdown_code');
        var mdHtml = marked(markdownCode.text());
        $('#markdown_code').html(mdHtml).css("visibility", "visible");

        // 手风琴。文档树的折叠与展开
        $('#file_tree').find('.tree-dir').on('click', function (e) {
            e = e || window.event;

            $(this).closest('li').children('ul').slideToggle('fast');

            // 阻止冒泡
            e.stopPropagation ? e.stopPropagation() : (e.cancelBubble = true);
        });

        // 代码高亮
        $('#markdown_code pre code').each(function (index, element) {
            Prism.highlightElement(element);
        });

        // 选中当前树节点
        var currentNote = $('#<?= $currentId ?>');
        currentNote.parentsUntil('#file_tree', 'li>ul').css("display", "block");

    });

</script>

<script src="<?= Conf::$all['base_url'] ?>asset/lib/marked.js"></script>
<script src="<?= Conf::$all['base_url'] ?>asset/lib/prism/prism.js"></script>

</body>
</html>
