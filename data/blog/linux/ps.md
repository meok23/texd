# ps进程解读

## STAT

```
D    不可中断 Uninterruptible sleep (usually IO)
R    正在运行，或在队列中的进程
S    处于休眠状态
T    停止或被追踪
Z    僵尸进程
W    进入内存交换（从内核2.6开始无效）
X    死掉的进程

<    高优先级
N    低优先级
L    有些页被锁进内存
s    包含子进程
+    位于后台的进程组
l    多线程，克隆线程 multi-threaded (using CLONE_THREAD, like NPTL pthreads do)
```
