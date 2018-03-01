# yii2数据库操作1秒以上

测试yii2的时候，发现数据库操作很慢，定位到了是实例化`\PDO`的时候慢，进一步定位发现是域名解析的问题，代码如下：

```
$start_time = microtime(true);

$dsn = 'mysql:host=localhost';
$username = 'root';
$password = 'root';

$pdo = new \PDO($dsn, $username, $password);
$consume_time = microtime(true) - $start_time;

echo '<br>' . 'consume_time' . $consume_time;
```

把上面代码`$dsn`里面的`localhost`改成`127.0.0.1`，就正常了。
