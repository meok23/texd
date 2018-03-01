
```
firewall-cmd --zone=public --list-ports
firewall-cmd --zone=public --add-port=80/tcp --permanent
firewall-cmd --zone=public --query-port=80/tcp
firewall-cmd --reload
cat /etc/firewalld/zones/public.xml
firewall-cmd --remove-port=80/tcp --permanent
```
加了`--permanent`的命令，要执行`firewall-cmd --reload`，才会立即生效
