昨天，用一个整型去取模一个浮点型，结果是浮点型，js
刚，js，怎么算都不对的，原来input控件传来的值是string，通过*或/，string能够转为number运算，可是+运算符，如果表达式中有存在string，那么number也当string去运算了，就是拼字符串了。

button的id不要设置为submit,否则可能会引起混淆，导致表单的submit()方法不能提交表单

叹号后面跟函数!function
和加号后面跟函数+function
都是跟(function(){})();这个函数是一个意思，都是告诉浏览器自动运行这个匿名函数的，因为!+()这些符号的运算符是最高的，所以会先运行它们后面的函数

background-position 水平垂直
图片的顶点 在盒子的定位

Javascript语言的特殊之处，就在于函数内部可以直接读取全局变量；
闭包就是能够读取其他函数内部变量的函数；
本质上，闭包就是将函数内部和函数外部连接起来的一座桥梁;

模块加载
```
//AMD
require(['moduleA', 'moduleB', 'moduleC'], function (moduleA, moduleB, moduleC)
{
   alert('加载成功');
});

//CMD
seajs.use("../static/hello/src/main")

//CommonJS
module.export = {
   name:'rouwan'
}

//es6模块
import {module1, module2} form './module.js';
```
