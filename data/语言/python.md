
## 特殊语法

赋值

```python
a, b = 0, 1
a, b = b, a+b
```

循环的 else 语句，在循环结束后执行，除非有break

```python
for i in range(0, 5):
    print(i)
else:
    print("Bye bye")
```

## 数据结构

列表，与php数组类型，不过可以使用负索引，可以切片

```python
a = [ 1, 342, 223, 'India', 'Fedora']
a
a[-2]
a[2:3]
a[:]
```

列表推导式

```python
squares = [x**2 for x in range(10)]
```

元组，逗号分隔符，不可编辑

```python
a = ('we', 23)
```

集合，集合是一个无序不重复元素的集。类似json数组

```python
b = {'we','',23}
```

字典，类型json对象

## 函数

1. 关键字参数
2. 强制关键字参数
3. 文档字符串
4. 高阶函数

## 文件操作

1. with 语句。它是 try-finally 块的简写
