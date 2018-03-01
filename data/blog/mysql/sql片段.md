
## select 效率

不要在where子句中“=”左边进行运算，否则将可能无法正确使用索引；
尽量避免在where子句中对字段进行null值判断，否则将导致全表扫描；
尽量避免在where子句中使用!=或<>操作符，否则将导致全表扫描；
尽量避免在where子句中使用or来连接条件，否则将导致全表扫描

## 模糊查询

like
```
where field like '_关键字%'
where concat(field-1, field-2, field-3) like '%关键字%'

_表示单个通配符
%表示零或多个通配符
```

正则
```
regexp/not regexp
rlike/not rlike

上面两组操作符应该是一样的作用

where field regexp '正则表达式'
```

## 索引

```
索引之于数据库就像目录之于书本；
索引对select友好，如果没有索引，每次查询都要遍历表，有索引就从索引中找；
可是每次insert/update 的时候，都要重建索引
```

## 常用命令

```
desc 表名
describe 表名
show columns from 表名
show create table 表名

如何使得mysql查询时结果不自动换行 而是增加滚动条
select * from test \G

oracle中可以使用的 set linesize 1000 这种语句

查询连接用户列表
show full processlist;
mysqladmin -uroot -p -hlocalhost processlist
```

## 从现有表创建新表

```
MYSQL不支持:
Select * Into new_table_name from old_table_name;
替代方法:
Create table new_table_name (Select * from old_table_name);
```

## 把查询的结果插入到新的表

```
select * into 新表 from 旧表 where ...
要插入的新表不存在（不支持mysql）

insert into 新表 (字段1,字段2,...) select (字段1,字段2,...) from 旧表 where ...
要插入的新表已存在

Create table 新表 (Select A.id,B.id as typeId,A.brand,A.quanpin,A.simple from brands as A,cartype as B where A.type=B.name group by A.brand);
```

## 导出导入数据

```
select * from action_bak limit 10 into outfile '/tmp/action_bak_2010_07_30';
load data infile '/tmp/action_bak_2010_07_30' into table action_bak;

mysqldump -uroot -p wak >your.sql
mysql> source your.sql;
```

## 一个存储过程例子

```
delimiter $$
drop procedure if exists wk;
create procedure wk()
begin
set @i=1;
while @i<100 do
if @i<10 then
set @fix=CONCAT('0',@i);
else
set @fix=@i;
end if;
select CONCAT('sns_media_info_tbl_',@fix);
set @i=@i+1;
end while;
end $$

delimiter ;

call wk();
drop procedure if exists wk;
```

## 标志位

```
& >0判断
| 赋值
^ 置反

SELECT id,`name`,zone_id FROM rk_store WHERE flag&0x1<>0
```
