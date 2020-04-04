<?php
require_once '../vendor/autoload.php';

use JsonHelper\Collection;
use JsonHelper\Str;

//创建集合
$collection = collect([1, 2, 3]);
print_r($collection);

//为集合扩展方法
Collection::macro('toUpper', function () {
    return $this->map(function ($value) {
        return Str::upper($value);
    });
});
$collection = collect(['first', 'second']);
$upper = $collection->toUpper();
print_r($upper);

//all 方法简单返回集合表示的底层数组
print_r(collect([1, 2, 3])->all());

//avg 方法返回所有集合项的平均值
$average = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');
$average = collect([1, 1, 2, 4])->avg();

//chunk 方法将一个集合分割成多个小尺寸的小集合
$collection = collect([1, 2, 3, 4, 5, 6, 7]);
$chunks = $collection->chunk(4);
print_r($chunks);

//collapse 方法将一个多维数组集合收缩成一个一维数组
$collection = collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
$collapsed = $collection->collapse();
$collapsed->all();
print_r($collapsed->all());

//combine 方法可以将一个集合的键和另一个数组或集合的值连接起来
$collection = collect(['name', 'age']);
$combined = $collection->combine(['George', 29]);
print_r($combined);

//concat 方法可用于追加给定数组或集合数据到集合末尾
$collection = collect(['John Doe']);
$concatenated = $collection->concat(['Jane Doe'])->concat(['name' => 'Johnny Doe']);
$concatenated->all();

//contains 方法判断集合是否包含一个给定项
$collection = collect(['name' => 'Desk', 'price' => 100]);
$collection->contains('Desk');
// true
$collection->contains('New York');
// false
//你还可以传递一个键值对到 contains 方法，这将会判断给定键值对是否存在于集合中
$collection = collect([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
]);
$collection->contains('product', 'Bookcase');
// false

//count 方法返回集合中所有项的总数
$collection = collect([1, 2, 3, 4]);
print_r($collection->count());

//countBy 方法用于计算集合中某个值出现的次数。默认情况下，该方法会计算每个元素的出现次数
$collection = collect([1, 2, 2, 2, 3]);
$counted = $collection->countBy();
print_r($counted->all());
//你还可以传递一个回调到该方法以便通过自定义的值计算元素出现次数
$collection = collect(['alice@gmail.com', 'bob@yahoo.com', 'carlos@gmail.com']);
$counted = $collection->countBy(function ($email) {
    return substr(strrchr($email, "@"), 1);
});
print_r($counted->all());

//crossJoin 方法会在给定数组或集合之间交叉组合集合值，然后返回所有可能排列组合的笛卡尔积
$collection = collect([1, 2]);
$matrix = $collection->crossJoin(['a', 'b']);
print_r($matrix->all());

//diff 方法将集合和另一个集合或原生 PHP 数组以基于值的方式作比较，这个方法会返回存在于原来集合而不存在于给定集合的值
$collection = collect([1, 2, 3, 4, 5]);
$diff = $collection->diff([2, 4, 6, 8]);
print_r($diff->all());

//diffAssoc 方法会基于键值将一个集合和另一个集合或原生 PHP 数组进行比较。该方法返回只存在于第一个集合中的键值对
$collection = collect([
    'color' => 'orange',
    'type' => 'fruit',
    'remain' => 6
]);
$diff = $collection->diffAssoc([
    'color' => 'yellow',
    'type' => 'fruit',
    'remain' => 3,
    'used' => 6
]);
$diff->all();
// ['color' => 'orange', 'remain' => 6]

//diffKeys 方法会基于犍将一个集合和另一个集合或原生 PHP 数组进行比较。该方法会返回只存在于第一个集合的键值对
$collection = collect([
    'one' => 10,
    'two' => 20,
    'three' => 30,
    'four' => 40,
    'five' => 50,
]);
$diff = $collection->diffKeys([
    'two' => 2,
    'four' => 4,
    'six' => 6,
    'eight' => 8,
]);
$diff->all();

//duplicates 方法从集合中检索并返回重复值
$collection = collect(['a', 'b', 'a', 'c', 'b']);
$collection->duplicates();
$employees = collect([
    ['email' => 'abigail@example.com', 'position' => 'Developer'],
    ['email' => 'james@example.com', 'position' => 'Designer'],
    ['email' => 'victoria@example.com', 'position' => 'Developer'],
]);
$employees->duplicates('position');

//each 方法迭代集合中的数据项并传递每个数据项到给定回调
$collection = $collection->each(function ($item, $key) {
    //
});
//如果你想要终止对数据项的迭代，可以从回调返回 false
$collection = $collection->each(function ($item, $key) {
    if ($key==5) {
        return false;
    }
});

//eachSpread 方法会迭代集合项，传递每个嵌套数据项值到给定集合
$collection = collect([['John Doe', 35], ['Jane Doe', 33]]);
$collection->eachSpread(function ($name, $age) {
    //
});
//你可以通过从回调中返回 false 来停止对集合项的迭代

//every 方法可以用于验证集合的所有元素能够通过给定的真理测试
collect([1, 2, 3, 4])->every(function ($value, $key) {
    return $value > 2;
});
// false
//如果集合为空，every 方法将返回 true
$collection = collect([]);
$collection->every(function($value, $key) {
    return $value > 2;
});

//except 方法返回集合中除了指定键的所有集合项
$collection = collect(['product_id' => 1, 'price' => 100, 'discount' => false]);
$filtered = $collection->except(['price', 'discount']);
$filtered->all();
// ['product_id' => 1]

//filter 方法通过给定回调过滤集合，只有通过给定真理测试的数据项才会保留下来
$collection = collect([1, 2, 3, 4]);
$filtered = $collection->filter(function ($value, $key) {
    return $value > 2;
});
$filtered->all();
// [3, 4]
//如果没有提供回调，那么集合中所有等价于 false 的项都会被移除
$collection = collect([1, 2, 3, null, false, '', 0, []]);
$collection->filter()->all();
// [1, 2, 3]

//first 方法返回通过真理测试集合的第一个元素
collect([1, 2, 3, 4])->first(function ($value, $key) {
    return $value > 2;
});
//你还可以调用不带参数的 first 方法来获取集合的第一个元素，如果集合是空的，返回 null
collect([1, 2, 3, 4])->first();

//firstWhere 方法会返回集合中的第一个元素，包含键值对
$collection = collect([
    ['name' => 'Regena', 'age' => 12],
    ['name' => 'Linda', 'age' => 14],
    ['name' => 'Diego', 'age' => 23],
    ['name' => 'Linda', 'age' => 84],
]);
$collection->firstWhere('name', 'Linda');
// ['name' => 'Linda', 'age' => 14]
//还可以调用带操作符的 firstWhere 方法
$collection->firstWhere('age', '>=', 18);
// ['name' => 'Diego', 'age' => 23]
//和 where 方法一样，你可以传递一个参数到 firstWhere 方法。在这种场景中，firstWhere 方法将返回给定键值对应的第一个项目
$collection->firstWhere('age');
// ['name' => 'Linda', 'age' => 14]

//zip 方法在与集合的值对应的索引处合并给定数组的值
$collection = collect(['Chair', 'Desk']);
$zipped = $collection->zip([100, 200]);
print_r($zipped->all());

// [['Chair', 100], ['Desk', 200]]