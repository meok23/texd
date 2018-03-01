#!/bin/bash

# 参数校验
if [ -z $1 ] || [ -z $2 ]
then
	echo "参数错误，请输入目录与注释"
	exit
fi

# 查找出需要 commit的文件
fs=`svn status $1 | grep '^A' | awk '{printf "%s ",$2}'`

# 遍历 commit
for loop in $fs
do
	svn commit $loop -m "${2}" --depth empty
done
