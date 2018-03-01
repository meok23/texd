#!/usr/bin/expect -f
set password 123456

set timeout 300
spawn bash -c "rsync -vazu --progress --delete /var/www/www.lihuobao.cn root@10.175.202.171:/var/www/"
expect "*password:"
send "$password\r"
send "exit\r"
expect eof
