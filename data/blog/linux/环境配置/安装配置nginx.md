# 安装配置nginx

## 准备 yum 仓库

To add NGINX yum repository, create a file named /etc/yum.repos.d/nginx.repo and paste one of the configurations below:

```
[nginx]
name=nginx repo
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/
gpgcheck=0
enabled=1
```

上面准备好了 Nginx 仓库，可以使用 yum 安装了，不过，我想使用 **源码安装**

安装Nginx依赖包：`yum-builddep nginx`

## 开始安装

把源码包复制到 /usr/local/src 并解压，进入解压后的目录

```
./configure
make
make install 2>&1 | tee install-20170519.log
make clean
```
By default, NGINX will be installed in /usr/local/nginx.

## 配置

配置其实蛮简单的, `/usr/local/nginx/conf/nginx.conf`

执行 `/usr/local/nginx/sbin/nginx`，并将其写入 `/etc/rc.d/rc.local`[注意执行权限]
关闭使用 `/usr/local/nginx/sbin/nginx -s stop` 命令

外网访问超时，在终端执行 curl localhost 能正常访问，猜测是防火墙的问题
```
firewall-cmd --add-port=80/tcp --permanent
firewall-cmd --reload
```

## 补充

```
[不支持path_info](http://huoding.com/2013/10/23/290)
[try_files的解释](http://www.nginx.cn/279.html)
[](http://www.nginx.cn/426.html)

##404，在http模块下配置
fastcgi_intercept_errors on;
error_page 404  /404.html;

##location
location  / { }匹配任何查询，因为所有请求都以 / 开头
location / {
    stub_status on; #开启统计，nginx的访问量
    allow 127.0.0.1;
    deny all;
}
```
