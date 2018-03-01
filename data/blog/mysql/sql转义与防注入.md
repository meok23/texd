
# 什么是sql注入

sql注入的关键点在where条件上面。举例说明：

## or

1 常规访问 delete.php?id=3;
```
$sql = 'delete from news where id = '.$_GET['id'];
```

2 恶意访问 delete.php?id=3 or 1;
```
$sql = 'delete from news where id = 3 or 1';
如此执行后，所有的记录将都被删除
```

## --注释

```
正常语句
select * from xxtbl where username='zhangsan' and password='123456'

注入语句
select * from xxtbl where username='zhangsan --' and password='123456'
```

# 如何防范sql注入

1 在拼接sql语句之前，判断参数是否合法：数据类型、长度、包含的关键字……

> 比如上例的id必须是数字。
> 坚信客户端传过来的数据是不可信的。

2 执行sql之前，对sql进行转义。
v1.0 使用 addslashes() 简单粗暴直接加反斜杠：

```
if(!get_magic_quotes_gpc()) {
  // 如果魔术引号没开
	$data = addslashes($data);
}
```

v2.0 mysql_real_escape_string()：
mysql_real_escape_string() 与 addslashes() 的区别就是: mysql_real_escape_string()需要连接数据库，考虑了连接的字符集，能转义的特殊字符更多。

3 使用sql组装方式，参数化查询。

pdo
```
$pdo = new PDO('mysql:dbname=dbtest;host=127.0.0.1;charset=utf8', 'user', 'pass');

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('SELECT * FROM employees WHERE name = :name');
$stmt->execute(array('name' => $name));

foreach ($stmt as $row) {
	// do something with $row
}
```

mysqli
```
$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name);

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
	// do something with $row
}
```

上面三点可配合使用。单一点是不行的，比如 [delete.php?id=3 or 1] 使用sql转义就解决不了。

# 参考文献

- http://www.cnblogs.com/qingling/archive/2013/01/22/2871692.html
- http://blog.csdn.net/lyjtynet/article/details/6261169
- http://www.cnblogs.com/labs/archive/2009/05/12/1455096.html
- http://blog.csdn.net/HornedReaper1988/article/details/43520257

2017-09-29
