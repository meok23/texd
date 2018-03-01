realpath() 函数返回绝对路径。该函数删除所有符号连接（比如 '/./', '/../' 以及多余的 '/'），返回绝对路径名。那时用kindeditor就是烦这个符号连接
array_filter 不使用第二个参数能够过滤数组中的空元素

```
## 关于 与运算 ## ********************************************************************************

& 按位与
&& 短路与/逻辑与

echo 2 & 'a'; // 0
echo 2 && 'a'; // 1

if (0 && $ret) {
    //一定执行不到这里
}

条件 && 某语句; <=> if (&&) { 某语句 }

没有数学中的负负得正假假为真的说法的。

看到这里，我们应该知道了，使用逻辑运算符（与、或）的时候，要使用短路的，也就是写两遍的那个，写一遍的那个是按位运算。#
********************************************************************************
```

```
## 图像处理 ##
********************************************************************************
bool imagecopyresampled(resource dst_image,resource src_image,int dst_x,int dst_y,int src_x,int src_y,int dst_w,int dst_h ,int src_w,int src_h)

dst_image 目标图像
src_image 源图像

dst_x     目标的开始绘图坐标，顶点是dst_image的左上角
dst_y

src_x     源图的开始裁剪坐标，顶点是src_image的左上角
src_y

dst_w     目标绘图区域的宽度，注意，并不是dst_image的宽度
dst_h

src_w     源图裁剪区域的宽度，注意，并不是src_image的宽度
src_h


dst_image是墙，src_image是瓷砖，把src_image贴到dst_image。

之前我还郁闷，为什么imagecopyresampled的参数函数有dst_w/dst_h/src_w/src_h？它自己不会从dst_image/src_image里面获取啊？
后来才知道，原来dst_w/dst_h/src_w/src_h并不是dst_image/src_image的宽度高度。

src_image根据src_x/src_y和src_w/src_h进行裁剪，裁剪好了之后，缩放成dst_w/dst_h的大小，最后贴到dst_image上面去，贴的时候，要保证顶点对应。
解的：imagecopyresampled是图片的缩放函数。
有空的时候，做个动画来解释这一过程。
********************************************************************************
```
