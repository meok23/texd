# 安装配置php

## 指定仓库安装php

```
yum list all --enablerepo=remi,remi-php56 | grep php

yum -y --enablerepo=remi,remi-php56 install  php php-common
yum -y --enablerepo=remi,remi-php56 install php-cli php-pear php-pdo php-mysqlnd php-gd php-mbstring php-mcrypt php-xml php-opcache
yum -y --enablerepo=remi,remi-php56 install php-pecl-memcache php-pecl-memcached php-pecl-mongo php-pecl-mongodb php-pecl-redis
yum -y --enablerepo=remi,remi-php56 install php-pecl-amqp php-pecl-xdebug

# 安装php-fpm
yum -y --enablerepo=remi,remi-php56 install php-fpm
```

## php 配置文件

```
第一类
/etc/php.ini
/etc/php.d/*

第二类
/etc/php-fpm.conf
/etc/php-fpm.d/*

第三类
user.ini #存在代码目录中
ini_set() #存在代码文件中
```

## php-fpm 与 tmp

通过浏览器访问的 /tmp 路径其实不是Linux的/tmp，因为php-fpm做了私有设置；
每次重启php-fpm 都会在 /tmp 目录下面建立一个 systemd-private-* 目录，每次都不一样；
/usr/lib/systemd/system/php-fpm.service 的PrivateTmp选项设置为false，php-fpm就不会使用私有化的/tmp目录了；
注意：需要 systemctl daemon-reload，然后再 systemctl restart php-fpm.service，修改才会生效；
另外，不建议修改PrivateTmp。

## 文件权限

```
chmod -R 777 Runtime/
chown -R nginx:nginx /var/lib/php/session/

apache权限 改为 nginx权限
=========================
/var/log/
drwxrwx---. 2 apache  root      4096 Oct 10 03:51 php-fpm
chown -R nginx:root php-fpm

=========================
/etc/php-fpm.d/www.conf
;user = apache
user = nginx
;group = apache
group = nginx
```
