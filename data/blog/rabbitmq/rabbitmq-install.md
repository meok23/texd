
# rabbitmq的安装与管理

在其[官网](http://www.rabbitmq.com)有各种安装包，大家自行去下载安装即可，我这里简单介绍一下rabbitmq yum的安装方式。

> 我的操作系统是 `CentOS Linux release 7.3`

```
# 安装rabbitmq服务
yum install -y rabbitmq-server

# 开启rabbitmq服务并设置开机启动
systemctl start rabbitmq-server.service
systemctl enable rabbitmq-server.service
```

## 使用web界面管理

```
# 开启web管理工具并重启rabbitmq服务
rabbitmq-plugins enable rabbitmq_management
systemctl restart rabbitmq-server.service
```

在浏览器输入 http://IP地址:15672 默认账号密码都是 guest

接下来，在这个web界面就可以管理rabbitmq了，而且很简单，看看就懂的

## 使用rabbitmqctl命令行管理

用户管理
```
# 添加用户
rabbitmqctl add_user <username> <password>

# 删除用户
rabbitmqctl delete_user <username>

# 修改密码
rabbitmqctl change_password <username> <newpassword>

# 设置用户角色
rabbitmqctl set_user_tags <username> <tag>

tag 可以是: management/policymaker/monitoring/administrator
```

更多资料
- http://blog.csdn.net/u013256816/article/details/53524814
- http://www.rabbitmq.com/manpages.html
