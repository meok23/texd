# selinux

## 关闭selinux

查看SELinux状态：

```
/usr/sbin/sestatus -v
或者
getenforce
```

关闭SELinux：

1. 临时关闭（不用重启机器）：

```
setenforce 0
# setenforce 0 设置为permissive模式
# setenforce 1 设置为enforcing模式
```

2. 修改配置文件需要重启机器：

```
修改/etc/selinux/config文件，
将SELINUX=enforcing改为SELINUX=disabled，
重启机器即可
```

2018-01-29
