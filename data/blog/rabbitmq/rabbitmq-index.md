
# rabbitmq消息队列，初识

## 引言：可以使用消息队列的场景

我们经常会遇到一种需求，就是系统集成，可能是公司的遗留系统，也可能是第三方维护的系统，需要集成到现有系统里面去。
常见而且简单的做法就是，建立中间通信表，让这些系统往通信表里面写数据，然后让新的系统定时去轮询这些表。
这已经具备消息队列通信的雏形了，其中的通信表就是消息队列，它定义了消息的标准结构，并暂存待处理的消息。

> “消息队列”是在消息的传输过程中保存消息的 `容器`

## rabbiMQ 概念讲解

我们平时接触的网络服务模式，是这样的，如图：
![](/images/rabbit2.png)
客户端发起请求，服务端返回数据，数据来自服务端，由服务端生成。

而前面的模型却不适用于 rabbitMQ，rabbitMQ是一款 `消息代理服务器`，主要负责投递消息。可以这么说："它们不生产消息，只是网络的搬运工"。

![](/images/rabbit3.png)

### 虚拟机 vhost

对照 Apache 的虚拟机理解即可；用户权限控制的粒度是 虚拟机。

### 信道 channel

建立在真实TCP连接内的虚拟连接，相比TCP的建立与销毁更廉价。

### 生产者和消费者

从前面的图可以看到，生产者和消费者分别在 RabbitMQ 的两边，生产者把消息发给 RabbitMQ，RabbitMQ 把消息发给消费者。实际上，生成者和消费者都是我们自己编写的应用程序，不属于 RabbitMQ。

### 交换机 exchange

前面说到，生产者把消息发给 RabbitMQ。其实，具体是发给 RabbitMQ 的特定交换机。而交换机不是一开始就存在的，它是由生产者或消费者创建的，交换机可以存在多个，使用不同的名字区分。

#### 默认交换机没有名字
- rabbitmq 服务器肯定存在一个默认交换机
- 所有队列都会自动绑定到默认交换机，并以队列名作为路由键

### 消息队列 queue

前面还说到，RabbitMQ 把消息发给消费者。其实，具体是 RabbitMQ 的特定消息队列把消息发给消费者。队列一开始也是不存在的，它是由生产者或消费者创建的，可以存在多个，使用不同的名字区分。

### 路由键 routingkey

生产者发送消息的时候，会给消息加上指定的路由键的。

你可以理解成信件的邮政编码。

### 绑定

到目前为止，我们知道，生产者把消息发给 RabbitMQ 的交换机，RabbitMQ 的特定消息队列把消息发给消费者。可还是没有贯穿起来呀，交换机到消息队列的路还没有打通。

这个时候，就需要绑定啦。这个动作通常由消费者进行，绑定的同时，还需要指定路由键。

> 注：有些教程，消息携带的叫路由键，此时指定的叫绑定键，其实本就是一样的东西，取两个名字反而不易理解。这里统一叫路由键

一个交换机可以绑定多个队列，一个队列可以绑定多个交换机，它们是多对多的关系。

消息到了交换机之后，RabbitMQ 把它投递给绑定的队列。这样，好像贯穿起来了，等等，路由键怎么用？这就需要配合交换机的类型来使用了。

### 交换机的类型

header交换机不建议使用，不做讲解。以下三种交互机，直连交换机用的最多

#### 直连交换机 direct

据前文得知，消息携带路由键、交换机与队列绑定的时候也指定的路由键。

消息到达交换机之后，面对多个绑定的队列，应该如何投递呢？投递到绑定时所指定的路由键，与消息本身携带的路由键一致的队列即可。

#### 扇形交换机 fanout

扇形交换机，路由键不起作用，所有绑定到扇形交换机上面的队列，都会被广播到消息。

#### 主题交换机 topic

与直连交换机类似，只不过不需要路由键完全一致，只要关键字匹配即可。

## 注意事项

1. 同一个队列，每一条消息，正常情况下，只会发给一个消费者。

2. 在消息确认之前，消费者程序异常退出或中断，则消息会发给下一个订阅了此队列的消费者，当然，前提是存在这样一个消费者。

3. 如果发现当前消费者把队列a绑定到了交换机a，可是却收到交换机b发来的消息。有可能是队列a在其它地方被绑定了交换机b，因为交换机跟队列的绑定关系是多对多的。

## 最后，奉上一张思维导图，以供扩展

![](/images/rabbit1.png)
