# apache虚拟机配置

一般需要关心两个地方：

1. 加载vhost模块
2. 配置虚拟机

## 常见错误

1. 访问的文档权限不够，要755以上权限，例如：`chmod 755 /var/www/`；
2. SELinux或防火墙的原因，解决方法：先关闭SELinux和firewall；
3. 虚拟主机配置错误。

## apache虚拟机配置文件

```
# 新版已经不需要这条配置了
# NameVirtualHost *:80

# 配置不是虚拟主机的默认主机
<VirtualHost _default_:80>
DocumentRoot "/var/www/html"
  <Directory "/var/www">
    Options -Indexes -FollowSymLinks +ExecCGI
    AllowOverride All
    Order allow,deny
    Allow from all
    Require all granted
  </Directory>
</VirtualHost>

# 配置虚拟主机
<VirtualHost *:80>
    DocumentRoot "/media/sf_www"
    ServerName ct7-1
    ServerAlias
  <Directory "/media/sf_www">
      Options Indexes FollowSymLinks ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
     Require all granted
  </Directory>
</VirtualHost>
```

## 一个实例

刚刚我配置apache虚拟主机的时候，新建`/etc/httpd/conf.d/vhost.conf`，内容如上，并把`httpd.conf`及`/etc/httpd/`下的其它相关配置文件都看遍了，实在没发现什么问题了，可是一直报错403。
然后网上找找灵感，发现了目录权限的问题。

执行命令`ll /media/sf_www`看到目录权限是770，其它人连读的权限都没有，肯定不行呀。
于是我执行命令`chmod 775 /media/sf_www/test.html`，准备测试看看。`chmod`没有执行好像成功了，没有报错，可是`ll`命令一看，权限依旧是770。
`/media/sf_www`是virtualbox的共享目录，估计这个共享目录改不了权限的。

网上搜了个方法，把apache用户加入vboxsf组，因为`/media/sf_www`是vboxsf组的，`usermod -aG vboxsf apache`，组了加入了，可是403依旧。

```
chmod 755 /media/sf_www/index.html
usermod -aG vboxsf apache
whoami
groups apache
gpasswd -d apache vboxsf
```

继续呗，换个方法，手动挂载共享目录。把虚拟机设置`共享文件夹`自动挂载的勾去掉，然后执行命令`mount -t vboxsf www /media/sf_www`，手动挂载，之后执行`ll`命令，观察到目录权限变为777了。
看起来好像可以了，可是依旧报错403，最后吧selinux关了，重启电脑，搞掂。

2018-01-29
