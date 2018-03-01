
. 重复上次操作

## 查找替换
```
/ 查找
:nohls 取消选中
* # 查找当前单词
:%s/命中模式/替换词/g
:$s/\c查找字/&/gn 查找匹配的个数
g+d |*|# 全字匹配
```

## 正则
```
在行首插入一个逗号
/^
:%s/\1/,
```

## 删除空白行
```
:g/^\s*$/d

:g 代表在全文档范围内
^代表行的开始
\s*代表空白字符
&代表行的结束
d代表删除
用//将3段代码隔开
```

## vim 插入
o 向下插入一行 O向上插入一行
i 往前插入 a 往后插入 A行尾插入 I 行首插入

## vim 光标
hjkl 光标
$ 行尾 0 行首
gg 首行 G尾行 nG 某一行
w 下一个单词的开头 e下一个单词的结尾 b 上一个单词 就是web嘛
t字符 跳转到第一个指定字符的前面
L 视图的最后一行
H 视图第一行
:set mouse=a "启用鼠标

]] 是向后找函数头。[] 是向前找函数尾，][ 是向后找函数尾。
记忆规律是这样：[ 开关的命令是向前找，] 是向后找。重复按两遍的，是按指定方向找函数头。

## vim 打开文件
:split :vsplit 分屏显示，Ctrl+ww切换
:e :open 打开另外的文件

## vim 文件
:Ex 目录列表 :Ve
:Te 目录列表，打开新的标签，gt切换标签
:f 或CTRL+G

## 标签
:tabnew     新建文件
:tabedit    打开新的标签
:tabc       关闭当前的tab
:tabo       关闭所有其他的tab
:tabs       查看所有打开的tab
:tabp      前一个
:tabn      后一个

gt gT 1gt {index}gt 标签切换

## vim 删除
D 删除到行尾
x        删除当前光标下的字符
dw       删除光标之后的单词剩余部分
d$       删除光标之后的该行剩余部分
d0       删除到行首
dd       删除当前行
dt字符 删除到指定字符
cc 清空一行并进入编辑
0D 清空一行不编辑

:g/^\s*$/d 删除空白行，解释如下：
g 代表在全文档范围内 ^代表行的开始 \s*代表空白字符 $代表行的结束 d代表删除 斜线/作为命令分隔符

## vim 黏贴
:set paste
然后切换为插入模式
然后，shift+insert

## vim 缩进
2== 缩进两行
:set shiftwidth=4 #设置缩进的宽度

1. ESC
2. Ctrl+v
3. j,k 选择范围
4. I（大写I）
5. Tab

## vim tab 四个空格

对于已保存的文件，可以使用下面的方法进行空格和TAB的替换：
TAB替换为空格：
:set tabstop=4
:set expandtab
:%retab!

空格替换为TAB：
:set ts=4
:set noexpandtab
:%retab!

加!是用于处理非空白字符之后的TAB，即所有的TAB，若不加!，则只处理行首的TAB。

## vim 移动和复制
copy的另外两个写法:co或者:t。 常用命令：
:3t. 拷贝第三行到当前光标的下一行
:t3 拷贝当前行到第三行的下一行
:t. 拷贝当前行到光标的一下行，相当于Yp和yyp
:t$ 拷贝当前行到最后一行
1,9 m 20 一到九行移动到第二十行
1,3 join 或 :1,3 j 合并行
1,3g/^/ join 合并行

## vim 配置
```
" 设置编码，要放文件头
set encoding=utf-8
set fileencodings=utf-8,gbk,gb18030,gk2312
language messages zh_CN.utf-8 " 设置console提示的编码

set nocompatible " 不与vi兼容
set nobackup " 不备份

set number " 显示行号
set cursorline " 当前行高亮
set cursorcolumn " 当前列高亮

" 语法高亮
syntax enable
syntax on

" 配色
set t_Co=256
set background=dark
colorscheme molokai

" 显示换行符和tab
set list
set listchars=tab:▸\ ,eol:¬

" tab空格
set tabstop=4
set shiftwidth=4
set expandtab

" 映射命令到快捷键
map <F5> :!php %
```

## vim 外部命令
:! php -l % 检查php语法
:shell #进入终端，Ctrl+D 退出终端进入编辑器

## vim diff
dp 从当前到隔壁。do 从隔壁到当前。
[+c 或 ]+c # 切换差异块

## 折叠
zo   打开折叠(l也可以打开折叠）
zc   关闭当前折叠

zr   打开所有折叠
zm   关闭所有折叠
za   若当前打开则关闭，若当前关闭则打开

## 只读模式，运行底行命令：
:set modifiable
:set nomodifiable

简写
set ma
set noma

## 对齐
:set autoindent
gg=G

## 插件

资源管理  NERDTree
类导航    Cscope ctag taglist tagbar
文件搜索  CtrlP unite
自动补全  YouCompleteMe
语法检查  Syntastic
