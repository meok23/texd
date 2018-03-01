
## 命令忽略
http://www.tuicool.com/articles/v6RfEb
不能忽略子目录以下的文件
svn propedit svn:ignore .

## tortoise忽略
http://ysj5125094.iteye.com/blog/2249895
右键 -> TortosieSVN -> Properties
svn:ignore、global-ignores区别：
1、svn:ignore：只对当前目录有效；
global-ignores：是全局有效，就是所有目前都有效；
2、svn:ignore：必须每个工作目录都要设置，个性化配置；
global-ignores：只需要配置一次，使用方便；

## 虚拟机目录
svn: E200030: sqlite: disk I/O error
https://zhidao.baidu.com/question/711738133377051285.html
使用虚拟机 共享目录，Linux与Windows公用 svn 就会有这个坑

## 提交
```
ls |xargs -t -i svn commit {} -m '发布v1'
svn status | grep D | sed 's/D//' | xargs -t -i svn delete {}
```

## 对比
```
svn diff -r r4098 --summarize http://14.18.242.145:8088/repos/sns_test | grep 'modules/article'
```
