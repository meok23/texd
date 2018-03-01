# cmd命令

/? -帮助

## 文件操作
```
删除目录
rd
rd /s *.php
删除所有子目录中文件名带有.php的文件

查询目录
dir
dir /s | find ".php"
在所有子中目录查找所有文件名带有.php的文件

重命名
ren *.jpg *.
```

## 网络命令
```
netstat -ano | findstr "3306"
查看3306端口

tasklist | findstr "3306"
查看3306端口的应用程序

tracert 目标地址
路由追踪，在Linux下面是traceroute
```

## 禁用U盘复制 “WriteProtect”的DWORD值 1禁止；0启用
```
[HKEY_LOCAL_MACHINE\SYSTEM\CurrentControLSet\Control]
在该分支下新建一个名为“StorageDevicePolicies”的子项，在该子项中右侧的新建名为“WriteProtect”的DWORD值，并将此值设置为0
[](http://dnswan.blog.51cto.com/1929050/971921)
```
