
# git-专题

## 忽略

### .gitignore
.gitignore 文件只能作用于未跟踪文件（Untracked Files），也就是那些从来没有被 Git 记录过的文件（自新建以后，从未 add 过的文件）

### 忽略已经追踪的文件
```
git rm --cached <文件路径>
删除追踪，让git不再track
这样操作之后，本地的文件还在，不过推送之后，远程的对应文件会被删除
```

如果一个文件在加入`.gitignore`之前已经add了，那么是无法忽略的，这时候，可以考虑使用上面的`git rm --cached`命令

## 部署网站
.git/hook/post-receive
```
#!/bin/sh
GIT_WORK_TREE=<目标路径> git checkout [分支] -f
```

`目标路径`要事先准备好
`分支`如果不是maser则要指明
chmod +x post-receive 需要执行权限
还要注意，`目标路径`必须是git的登录用户有写权限的目录，我上次就卡在这里了

## 换行符问题

新建`.gitattributes`文件，输入`* text=lf`，表示使用*nix类型的换行符

执行命令
```
# 忽略权限，不然，目录权限修改也会被git追踪的
git config --global core.filemode false

# 关闭自动转换换行符
git config --global core.autocrlf false

# 如果混用了几种换行符，则拒绝提交
git config --global core.safecrlf true
```

因为windows跟linux使用了不同的换行符，所以git提供了一个功能，在windows上面检出代码的时候，它会自动把换行符转成CRLF，commit的时候再转回LF。通常，事情到这里就结束了，然而，这个功能有bug，utf8格式的文件，检出的时候转成CRLF，commit的时候却不会转回来。

所以，我们的解决方案就是，在git客户端上关闭自动转换换行符，再把自己的编辑器设置成LF换行符

## 如何使用 vimdiff 来替代 git diff

```
git config --global diff.tool vimdiff
git config --global difftool.prompt false
git config --global alias.d difftool

然后使用 git d 打开对比代码，然后用 :wq 继续比较下一个文件。
```

另外，也可以不这么设置，而是在使用的时候 `git difftool -y`

## 获取远程
```
git fetch <远程库名>
git diff FETCT_HEAD
git merge FETCT_HEAD
手动解决冲突

或者

git fetch origin master:tmp
git diff tmp
git merge tmp
git branch -D tmp

改天研究一下：fetch使用不同参数分别做了什么事，与pull有什么区别
```

## 合并特定文件
1. git merge 只能合并分支或者合并 commit
2. 如果想要合并特定文件的话，需要使用 diff 找出差异，手动合并
3. 考虑打补丁的方式

## 报错提示

```
error: remote unpack failed: unpack-objects abnormal exit
远程仓库目录权限问题
```

```
fatal: LF would be replaced by CRLF in modules/admin/xmen_admin/vendor/bower/jquery.inputmask/.editorconfig

在windows上报的错，可是我已经设置了`core.autocrlf false`，估计是目录中包含带点文件夹`/jquery.inputmask/`的原因
```
