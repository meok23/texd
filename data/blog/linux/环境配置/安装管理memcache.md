# 安装管理memcache

## 安装

服务

```
yum -y install memcached
systemctl enable memcached.service
systemctl start memcached.service
```

管理

```
yum -y install telnet
telnet 127.0.0.1 11211
quit
```

安装php的memcached扩展

```
解压 libmemcached 的源码，并进入解压后的目录
./configure --prefix=/usr/local/libmemcached --with-memcached
make
make install 2>&1 | tee install-20170621.log
make clean

pecl install memcached
在 libmemcached directory [no] 处输入 /usr/local/libmemcached

echo 'extension=memcached.so' >> /usr/local/php/etc/php.d/ext.ini
```

--- 20180119补充

我记得当时使用yum安装了libmemcached，依然不行，所以上面才使用源码再次安装了libmemcached。
现在想想，或许应该使用yum安装`libmemcached-devel`就可以了，改天试试。

## 管理

### 常用命令
```
telnet 127.0.0.1 11211 #登录memcache
stats #显示服务器信息、统计数据等
stats reset #清空统计数据
stats slabs #显示各个slab的信息，包括chunk的大小、数目、使用情况等
stats items #显示各个slab中item的数目和最老item的年龄(最后一次访问距离现在的秒数)
stats cachedump slab_id limit_num #显示某个slab中的前limit_num个key列表
```

### 单元
```
slabs > (chunks->items<=key)

stats slabs 和 stats items 得到的结果，其实是同一个维度的，主语都是slabs。每个slab有若干个chunk，每个chunk可以装一个item，slabs 里面的item数目等于chunks 的使用数目，一个item对应一个key。
```

### 注意事项
1 key最长 250个字符
2 key不能包含空格和控制字符
3 item的过期时间最长30天
4 单个item最多能存1M数据，如果你发现不是1M可能是压缩了
