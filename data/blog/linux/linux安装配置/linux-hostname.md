
# linux hostname 配置

与 hostname 相关的配置文件
```
/proc/sys/kernel/hostname
/etc/rc.d/rc.sysinit

/etc/sysconfig/network
/etc/hostname
/etc/hosts
```

## centos 7之前

```
/etc/sysconfig/network 设置hostname，需要重启系统生效；
/etc/rc.d/rc.sysinit 在每次开机的时候，从/etc/sysconfig/network读取hostname，写到/proc/sys/kernel/hostname；
/proc/sys/kernel/hostname 是系统运行时候的内存文件，hostname命令设置hostname就会作用到这个文件，重启失效；
```

一般情况下 /etc/hosts 只是本地dns文件，另外，网上摘抄如下：

```
rc.sysinit脚本判断hostname是否为localhost或者localhost.localdomain，如果是的话，将会使用接口IP地址对应的hostname来重写系统的hostname；
假设/etc/sysconfig/network设置的hostname是localhost，eth0的IP是127.0.0.1，而/etc/hosts里有127.0.0.1的记录，hostname被重写了；估计这也是很多人将/etc/hosts误以为是hostname配置文件的原因。
```

## centos 7+

```
/proc/sys/kernel/hostname 是系统运行时候的内存文件，hostname命令设置hostname就会作用到这个文件，重启失效；
/etc/hostname 设置主机名；
/etc/hosts 本地dns
```
