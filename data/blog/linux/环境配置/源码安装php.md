# 源码安装php

## 安装PHP核心

安装php依赖包：`yum-builddep php`

yum -y install readline-devel

### 开始安装

把源码包复制到 /usr/local/src 并解压，进入解压后的目录

```
./configure --prefix=/usr/local/php --with-config-file-path=/usr/local/php/etc --with-config-file-scan-dir=/usr/local/php/etc/php.d --with-pdo-mysql=mysqlnd --with-gd --with-jpeg-dir --with-curl --with-readline --with-openssl --with-zlib --with-libzip --enable-mbstring --enable-sockets --enable-bcmath --enable-fpm

# 需要清楚上面的每一项的意思，./configure --help | grep xxx

# --prefix=/usr/local/php php安装路径
# --with-config-file-path=/usr/local/php/etc php配置文件路径
# --with-config-file-scan-dir=/usr/local/php/etc/php.d php配置文件子路径，分布各个模块的配置文件
# --with-readline php命令交互支持
# --with-openssl 443支持，比如pecl安装
# --with-jpeg-dir gd库支持JPG

make
make test
make install 2>&1 | tee install-20170621.log
make clean
```

### 配置

```
cp /usr/local/src/php/php-7.1.5/php.ini-development /usr/local/php/etc/php.ini
cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf
cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf

make /usr/local/php/etc/php.d
touch /usr/local/php/etc/php.d/ext.ini

groupadd www
useradd -g www www
```

修改 www.conf
```
user = www
group = www
```

执行 `/usr/local/php/sbin/php-fpm`，并将其写入 `/etc/rc.d/rc.local`[注意执行权限]

验证
```
php -m
php --ini
ps -ef | grep php-fpm
netstat -tnl | grep 9000
```

## 安装php扩展

### 使用composer的时候，发现需要zlib

```
cd /usr/local/src/php/php-7.1.5/ext/zlib/
cp config0.m4 config.m4
phpize
./configure --with-php-config=/usr/local/php/bin/php-config

报warning: You will need re2c 0.13.4 or later if you want to regenerate PHP parsers

yum install -y re2c
./configure --with-php-config=/usr/local/php/bin/php-config
make
make install

echo 'extension=zlib.so' >> /usr/local/php/etc/php.d/ext.ini
```

### 项目需要bcmath

```
cd /usr/local/src/php/php-7.1.5/ext/bcmath
phpize
./configure --with-php-config=/usr/local/php/bin/php-config
make
make install
```
