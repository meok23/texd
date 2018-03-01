# 算法初解与二分查找法

## 时间复杂度

O(n) 线性时间
O(logN) 对数时间

## 对数

对数指数互为逆运算
对数: log(a)N=b, N的对数是b
指数: a^b=N, a的指数是b
指数即是对数

log(a)N=b, a是底数 / N是真数 / b是对数, 对数中的真数永远是正数

### 另类解读

指数: a^b=N中, a的指数b就是 `a*a*a...*a=N` 相乘是次数

对数：log(a)N=b中, N的对数b就是 `N/a/a.../a` 除尽为止, 除以的次数

## 栗子

问题：1 2 3 4 5 6 7 8，8个数，找出8

用简单查找法，从1数到8，需要8次，即时间复杂度是8
用二分查找法，切一半判断在不在，再切一半，只需要3次

小时候学过一种牌术，其实就是二分查找法

## 代码

```php
/**
 * 输出命中的数组下标
 *
 * @param array $arr
 * @param int   $item
 *
 * @return int
 */
function binary_search($arr, $item)
{
    // 定义数组最低最高下标
    $low = 0;
    $high = count($arr) - 1;

    // 循环搜索，当数组元素大于一位时
    while ($low <= $high) {
        // 取中间下标
        $mid = (int)(($low + $high) / 2);

        // 猜中间的值
        $guess = $arr[$mid];
        if ($guess == $item) {
            // 猜中了
            return $mid;
        } else if ($guess > $item) {
            // 猜大了
            $high = $mid - 1;
        } else {
            // 猜小了
            $low = $mid + 1;
        }
    }

    return -1;
}

$arr = [1, 2, 3, 4, 5, 6, 7, 8];
echo binary_search($arr, 7);
```
