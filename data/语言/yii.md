
composer create-project xx 文件夹
composer install
php init

httponly
lexer

get请求更容易遭受csrf跨站请求伪造
referer伪造

---

composer global require "fxp/composer-asset-plugin:^1.3.1"
composer create-project --prefer-dist yiisoft/yii2-app-advanced advanced

---

'attributes' => [PDO::ATTR_PERSISTENT => true]
persistent

---

我在封装了一个数据库操作类，以yii组件的方式，其使用方式与yii原生操作保持一致。

现在有一个问题，关于主从的：
yii原数据库操作类，如果启用了主从，则所有读操作都连接从库，不过可以使用useMaster方法直连到主库。

而我们之前的策略是所有操作都默认主库，需要从库的时候才连从库。

现在问：使用yii的方案？还是使用我们之前的方案？

使用yii的方案，写实现类的时候，代码量可能会多一些，因为要useMaster；
使用我们之前的方案，会导致代码跟yii的不一致

---

长连接
断线重连
主从数据库/自动摘除从库
sql慢查询记录
错误日志
安全性校验，比如空条件写操作/没有limit的读操作

close资源释放

执行事务
`_命名规范`

---

YII_ENV做什么用的

追加项目
environment/index.php
common/config/bootstrap.php

---

日志相关

怎么隐藏exception报错：隐藏不了
查看r=debug，日志数据取自哪里：文件runtime/debug

关闭日志：关不了

读一下FileTarget
日志写到数据库，为什么还会使用runtime/debug/目录，负载均衡怎么办

---

http://man.linuxde.net/ln
http://blog.csdn.net/lg632/article/details/52556139
