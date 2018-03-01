
# 使用说明

PHP实现的一个简单wiki框架

## 功能介绍

### 现有功能

- 左边是目录树，右边是文本
- 文件类型支持：`.png .jpg .gif .md`
- 导航目录: 超长则滚动，并打开当前树节点
- 本地插图路径重写

### 下一版预告

- 支持标签搜索
- 支持评论
- 支持导出pdf

## 部署

无需数据库，所有文档存储在`data/`目录下面，每次编辑了`data/`下面的文档，都需要执行：

```shell
./tex
```

进行编译操作，包括生成文档导航树

### 配置

打开`conf/common.php`，填写`base_url`，格式如下：

```
http://域名/

注意，如果部署到二级目录，需要拼接上目录名
http://域名/子目录/
```

### url重写

**nginx**

```
...
location / {
    if (!-e $request_filename) {
        rewrite ^(.*)$ /index.php?r=$1 last;
    }
}
...
```

**apache**

详见根目录的`.htaccess`文件

## 协议

Apache License 2.0
