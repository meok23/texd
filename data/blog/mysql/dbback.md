不久前，公司进行了一次数据库迁移，使用 mysqldump

```
mysqldump -uroot -ptoor test >test.sql
mysql>source d:\test.sql
```

结果导入的数据乱码，查得原因是数据库中使用了 urf8mb4 编码类型，固改之

```
mysqldump -uroot -ptoor --default-character-set=utf8mb4 test >test.sql
mysql>source d:\test.sql
```
