1. 关掉 AllowOverride，不要使用 .htaccess
如果AllowOverride启用了.htaccess文件，则Apache需要在每个目录中查找.htaccess文件，因此，无论是否真正用到，启用.htaccess都会导致性能的下降。另外，对每一个请求，都需要读取一次.htaccess文件。

2. 如果要使用 .htaccess，则要禁止用户访问 .htaccess 文件
<Files .htaccess>
order allow,deny
deny from all
</Files>

3. URL 重写
RewriteRule ^(.*)/(.*)$ index.php?c=$1&m=$2 [QSA,PT,L]
rewrite ^/(.*)/(.*)$ /index.php?c=$1&m=$2 last;
在匹配规则的前面，nginx 比 apache 多了一个 /
