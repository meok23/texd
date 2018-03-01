
# php操作rabbitmq

php操作rabbitmq有两种方式：
1. 使用php扩展 [php-amqp](https://github.com/pdezwart/php-amqp)
2. 使用php类库 [php-amqplib](https://github.com/php-amqplib/php-amqplib)

接下来要介绍的是php类库的方式

## 代码实现

### 加载类库

新增一个 composer.json 文件
```
{
    "require": {
        "php-amqplib/php-amqplib": ">=2.6.1"
    }
}
```

执行 `composer install`

> composer使用方式请参考 http://www.phpcomposer.com

### 生产者

producer.php
```php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 设置交换机名、路由键、队列名
$_conf = [
    'exchange_name' => 'ex_test_x',
    'route_key'     => 'rt_test_x',
    'queue_name'    => 'qu_test_x',
];

// 连接 rabbitmq 服务
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');

// 获取信道
$channel = $connection->channel();

// 声明交换机
$channel->exchange_declare($_conf['exchange_name'], 'direct');

// 创建消息
$data = "{$_conf['exchange_name']}#{$_conf['route_key']}#{$_conf['queue_name']} " . date('H:i:s');

$msg = new AMQPMessage($data);

// 发送消息
$channel->basic_publish($msg, $_conf['exchange_name'], $_conf['route_key']);

// 关闭信道和连接
$channel->close();
$connection->close();
```

### 消费者

consumer.php
```php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

// 设置交换机名、路由键、队列名
$_conf = [
    'exchange_name' => 'ex_test_x',
    'route_key'     => 'rt_test_x',
    'queue_name'    => 'qu_test_x',
];

// 连接 rabbitmq 服务
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');

// 获取信道
$channel = $connection->channel();

// 声明交换机
$channel->exchange_declare($_conf['exchange_name'], 'direct');

// 声明队列
$channel->queue_declare($_conf['queue_name']);

// 绑定队列
$channel->queue_bind($_conf['queue_name'], $_conf['exchange_name'], $_conf['route_key']);

// 定义回调函数
$callback = function ($msg) {
    // 消息确认
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

    if ($msg->body == 'quit') {
        // 停止消费并退出
        $msg->delivery_info['channel']->basic_cancel($msg->delivery_info['consumer_tag']);
    } else {
        echo 'Hello ', $msg->body, PHP_EOL;
    }
};

// 消费者订阅队列
$channel->basic_consume($_conf['queue_name'],
    '',
    false,
    false,
    false,
    false,
    $callback);

// 开始消费
while (count($channel->callbacks)) {
    $channel->wait();
}

// 关闭信道和连接
$channel->close();
$connection->close();
```

### 执行

```
# 启动消费者
php consumer.php

# 启动生产者
php producer.php
```

发现消费者会收到生产者发送过来的消息

---

更多源码与教程
- http://www.rabbitmq.com/getstarted.html
- https://github.com/rabbitinaction/sourcecode
