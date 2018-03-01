
# git-基本操作

## 提交

```
加入追踪或加入暂存
git add <文件路径>

提交到本地仓库，-a绕过add加入暂存，直接提交
git commit -a -m "备注"
```

使用过svn的童鞋知道，文件第一次commit之前，需要先add。而git，第一次commit之前肯定是需要add的，每次commit之前却也需要add，不过后面这个add是可以省略的。

- 第一次commit之前的add，是必需的，它的作用有两个：加入追踪、加入暂存
- 之后每次commit之前的add，可以省略，只需要在commit的时候加上`-a参数`

## 远程操作

远程操作命令就那么有限的几个：clone/fetch/pull/push
```
克隆文件
git clone <远程库url, 如git@code.csdn.net:xxx/xxx.git>
git clone ssh://user:pssword@url

指定深度、分支、本地目录
git clone https://github.com/xxx/xxx.git --depth 2 -b master ./www

获取文件
git fetch <远程库名/远程库url>

拉取文件
git pull <远程库名/远程库url> [远程分支名]:[本地分支名]
冒号助记 [来源地]:[目的地]

推送文件
git push <远程库名/远程库url> [本地分支名]:[远程分支名]
冒号助记 [来源地]:[目的地]
```

fetch 并不会更新工作目录，pull才会更新工作目录，pull是fetch和merge的合集

## 远程仓库列表

```
远程仓库列表
git remote

远程仓库列表，显示对应的地址
git remote -v

远程仓库信息
git remote show <远程库名>

远程仓库设置
git remote add <远程库名> <远程库url, 如git@code.csdn.net:xxx/xxx.git>
git remote rm <远程库名>
git remote rename <旧名称> <新名称>
```

远程仓库名称其实就是远程仓库url在本地的一个别名，方便用户不用每次都输入冗长的url地址
- 使用远程库名前: `git fetch https://github.com/xxx/xxx.git`
- 使用远程库名后: `git fetch origin`。当然，在这之前需要`git remote add origin https://github.com/xxx/xxx.git`

## 分支操作

```
创建分支，以当前分支为基准
git branch <分支名>

切换到分支
git checkout <分支名>

创建分支并切换到分支
git checkout -b <分支名>

以<origin/分支1>为蓝版，创建并切换到<分支2>分支
git checkout -b <分支2> <origin/分支1>

裸仓库切换当前分支
git symbolic-ref HEAD refs/heads/<分支名>

本地分支列表
git branch

远程分支列表
git branch -r

所有分支列表，本地远程兼有
git branch -a

删除本地分支
git branch -D <分支名>

删除远程分支
git push <origin> --delete <分支名>
git push <origin> :<远程分支名>
建议使用第一个命令

重命名本地分支
git branch -m <旧分支名> <新分支名>

删除远程分支在本地的痕迹
git branch -r -d <origin/分支名>
```

git的checkout跟svn的checkout不是一个意思的哦，svn的checkout更像git的clone+pull

## 标签

https://git-scm.com/book/zh/v1/Git-基础-打标签

## 查看

```
查看提交历史
git log

查看状态
git status

比较工作目录(Working tree)和暂存区域(index)之间的差异。查看修改之后还没有暂存的内容
git diff

比较已暂存的文件(staged)和上次提交时之间(HEAD)的差异。查看暂存了什么
git diff --cached
等价于git diff --staged

比较工作目录(Working tree)和HEAD的差别
git diff HEAD

比较当前分支和另一个分支的区别
git diff <分支名>

查看两次commit的区别
git diff 608e120 4abe32e

列出两次commit有区别的文件
git diff 608e120 4abe32e --name-only

打包所有差异文件
git diff 608e120 4abe32e --name-only | xargs zip update.zip
```

## 合并

```
git merge
有可能会带来冲突，它把冲突的代码块都放一起，然后合并完了之后，你在自己慢慢删减，就是这样解决冲突的
会产生新的commit

git rebase
把一个分支的修改合并到当前分支
遇到冲突的时候，会停下来，让你先解决冲突，然后再继续合并
会修改commit的历史
```

- 没有共同祖先的分支，不容易合并
- git merge 只能合并分支或者合并commit
- 参考资料：http://blog.csdn.net/hudashi/article/details/7664631/

## 返回与丢弃

丢弃尚未commit的本地修改
```
git checkout .
```

尚未push，使用reset，删除指定的commit
```
git reset --mixed [commit-hash]
等价于git reset，保留工作目录的修改，将commit和暂存区域回退到了某个版本

git reset --soft [commit-hash]
保留工作目录的修改，保留暂存区域，只回退到commit信息到某个版本

git reset --hard [commit-hash]
工作目录、暂存区域、commit信息全部回退
```

已经push，使用revert，生成新的commit覆盖之前的commit
```
git revert <commit-hash>
创建新的commit
```

其它
```
把所有没有提交的修改暂存到stash里面，可用git stash pop恢复
git stash
```
