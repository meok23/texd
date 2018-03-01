
# sql字符串转义

## 什么是sql字符串转义

给sql语句的一些特殊字符（单引号、双引号、反斜杠……）的前面加上反斜杠。

## 为什么sql字符串需要转义

单引号、双引号的转义是为了避免引号里面有引号；而反斜杠的转义是为了说明它真的是反斜杠，不是转义前缀；
最终目标就是，**所有发送到mysql服务器的sql语句都是安全可执行的**。

## 转义与sql注入

sql注入就是从客户端传过来的非法数据，不按开发者的设计意图产生恶意sql语句，进而在服务器执行。

那转义与sql注入又是什么关系呢，观察下面的语句：
```
INSERT INTO `quote_tbl` (`title`) VALUES ('This's the test data.')
```
This's 导致单引号里面存在单引号，所以这是个非法语句，会导致sql注入。
上面的语句转义后，应该是这样的，如下：
```
INSERT INTO `quote_tbl` (`title`) VALUES ('This\'s the test data.')
```

## 如何转义

### get_magic_quotes_gpc

> php5.4之后，始终返回 FALSE，因为 magic_quotes_gpc 被移除了

如果返回true，则所有 `$_GET/$_POST/$COOKIE` 的值都会自动被转义

### 常规转义

addslashes() — 转义，添加相应反斜杠前缀
stripslashes() — 反转义，去掉相应反斜杠

### sql字符串转义

- 使用以下函数，需要连接数据库
- 与addslashes功能类似，却比addslashes智能，考虑当前连接的字符集

mysql_real_escape_string()
mysqli_real_escape_string()

PDO::quote() 除了转义，还会给字符串用单引号括起来

### 例子

```
$var = '\tmp';
$sql = sprintf('INSERT INTO `quote_tbl` (`title`) VALUES (%s)', $pdoDbh->quote($var));
```

## 注意

### 转义的对象

是针对字段对应的值进行转义，而非对整个sql语句进行转义。

### 转义的作用域

转义只是作用于sql语句，真正存到数据库的数据还是原来的数据，没转义之前的。

### 反斜杠的转义

原始数据：`\tmp`；
期望传到mysql服务器的数据是这样的：`\\tmp`，可以这么处理：addslashes('\tmp')；
但是如果是手动转义，却需要写成这样：`\\\tmp`，因为转义语法对php也生效，所以，经过php解析之后三个反斜杠变成了两个反斜杠：
```
\\\tmp -> \\tmp
```
最终得到我们的期望值`\\tmp`，传给了mysql服务器

### 使用 prepare操作数据库时，sql语句无需转义

注意，是sql语句无需转义，拼接sql语句时，php字符串本身的转义语法无关。

## 参考文献

- http://php.net/manual/zh/function.get-magic-quotes-gpc.php
- http://php.net/manual/zh/function.addslashes.php
- http://php.net/manual/zh/function.stripslashes.php
- http://php.net/manual/zh/function.mysql-real-escape-string.php

2017-09-29
