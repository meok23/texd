# 安装配置mysql

## 安装mariadb

```
yum remove mariadb*
yum -y install mariadb-server

systemctl enable mariadb.service
systemctl start mariadb.service
```

如果只执行`systemctl start`不执行`systemctl enable`，会报错`Can't connect to local MySQL server through socket '/var/lib/mysql/mysql.sock'`

执行`mysql_secure_installation`，做一些初始化配置：
a)为root用户设置密码
b)删除匿名账号
c)取消root用户远程登录
d)删除test库和对test库的访问权限
e)刷新授权表使修改生效

## MySQL配置

```
flush privileges;
刷新数据库配置缓存，很重要

mysqladmin -u 用户名 -p password 新密码

INSERT INTO `user` VALUES ('192.168.1.23','root','*601B8607D0081F84B036C977E2488D9A2492D050','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','','','','',0,0,0,0,'','');

GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'toor' WITH GRANT OPTION;
```

## 监控MySQL访问日志

```
vim /etc/my.cnf
在[mysqld]里配置了
#general_log = 1
#general_log_file = /var/log/mysql_sql.log

systemctl restart mariadb.service
touch /var/log/mysql_sql.log
chmod 777 /var/log/mysql_sql.log

tail -f /var/log/mysql_sql.log

---

show global variables like '%general%';
set global general_log=on;

ls /var/lib/mysql
```
