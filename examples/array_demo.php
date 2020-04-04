<?php
require_once '../vendor/autoload.php';

use JsonHelper\Arr;
use JsonHelper\Collection;
//Arr::accessible() 方法会检查给定值是否可以通过数组方式访问
$isAccessible = Arr::accessible(['a' => 1, 'b' => 2]);
var_dump($isAccessible);
$isAccessible = Arr::accessible(new Collection);
var_dump($isAccessible);
$isAccessible = Arr::accessible('abc');
var_dump($isAccessible);
$isAccessible = Arr::accessible(new stdClass);
var_dump($isAccessible);

//Arr::add方法添加给定键值对到数组 —— 如果给定键不存在或对应值为空的话
$array = Arr::add(['name' => 'Desk'], 'price', 100);
print_r($array);
$array = Arr::add(['name' => 'Desk', 'price' => null], 'price', 100);
print_r($array);
$array = Arr::add(['name' => 'Desk', 'price' => 32], 'price', 100);
print_r($array);

//Arr::collapse() 方法将多个数组合并成一个
$array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
print_r($array);

//Arr::crossJoin 方法可以交叉连接给定数组，返回一个包含所有排列组合的笛卡尔乘积
$matrix = Arr::crossJoin([1, 2], ['a', 'b']);
print_r($matrix);
$matrix = Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II']);
print_r($matrix);

//Arr::divide 方法返回两个数组，一个包含原数组的所有键，另外一个包含原数组的所有值
[$keys, $values] = Arr::divide(['name' => [11,22],'value'=>['aa','bb']]);
print_r($keys);
print_r($values);

//Arr::dot 方法使用「.」号将将多维数组转化为一维数组
$array = ['products' => ['item' => [['lgid'=>1,'uprice'=>12],['lgid'=>2]]]];
print_r(Arr::dot($array));

//Arr::except 方法从数组中移除给定键值对
$array = ['name' => 'Desk', 'price' => 100];
$filtered = Arr::except($array, ['price']);
print_r($filtered);

//Arr::exists() 方法检查给定键在数组中是否存在
$array = ['name' => 'John Doe', 'age' => null];
$exists = Arr::exists($array, 'age');
var_dump($exists);

//Arr::first 方法返回通过测试数组的第一个元素
$array = [100, 200, 300];
$first = Arr::first($array, function ($value, $key) {
    return $value >= 150;
});
var_dump($first);
//默认值可以作为第三个参数传递给该方法，如果没有值通过测试的话返回默认值：
//$first = Arr::first($array, $callback, $default);

//Arr::flatten 方法将多维数组转化为一维数组
$array = ['name' => 'Joe', 'languages' => ['PHP', 'Ruby','age'=>12]];
$flattened = Arr::flatten($array);
print_r($flattened);

//Arr::forget 方法使用「.」号从嵌套数组中移除给定键值对
$array = ['products' => ['desk' => ['price' => 100]]];
Arr::forget($array, 'products.desk.price');
print_r($array);

//Arr::get 方法使用「.」号从嵌套数组中获取值
$array = ['products' => ['desk' => ['price' => 100]]];
$price = Arr::get($array, 'products.desk.price');
var_dump($price);
//Arr::get 方法还接收一个默认值，如果指定键不存在的话则返回该默认值
$discount = Arr::get($array, 'products.desk.discount', 0);

//Arr::has 方法使用「.」检查给定数据项是否在数组中存在
$array = ['product' => ['name' => 'Desk', 'price' => 100]];
$contains = Arr::has($array, 'product.name');
var_dump($contains);

//Arr::hasAny 方法检查给定集合中的任意项（通过 . 访问）是否在数组中存在
$array = ['product' => ['name' => 'Desk', 'price' => 100]];
$contains = Arr::hasAny($array, 'product.name');
var_dump($contains);
$contains = Arr::hasAny($array, ['product.name', 'product.discount']);
var_dump($contains);
$contains = Arr::hasAny($array, ['category', 'product.discount']);
var_dump($contains);

//Arr::isAssoc() 方法会在给定数组是关联数组时返回 true，如果一个数组没有包含从0开始的数字序列键，就被认为是「关联数组」
$isAssoc = Arr::isAssoc(['product' => ['name' => 'Desk', 'price' => 100]]);
var_dump($isAssoc);
$isAssoc = Arr::isAssoc([1, 2, 3]);
var_dump($isAssoc);
var_dump(Arr::isAssoc(['0'=>'11','1'=>2,'3'=>4]));

//Arr::last 方法返回通过过滤数组的最后一个元素
$array = [100, 200, 300, 110];
$last = Arr::last($array, function ($value, $key) {
    return $value >= 150;
});
print_r($last);
//我们可以传递一个默认值作为第三个参数到该方法，如果没有值通过真理测试的话该默认值被返回

//Arr::only 方法只从给定数组中返回指定键值对
$array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];
$slice = Arr::only($array, ['name', 'price']);
print_r($slice);

//Arr::pluck 方法从数组中返回给定键对应的键值对列表
$array = [
    ['developer' => ['id' => 1, 'name' => 'Taylor']],
    ['developer' => ['id' => 2, 'name' => 'Abigail']],
];
$names = Arr::pluck($array, 'developer.name');
print_r($names);
//你还可以指定返回结果的键
//$names = Arr::pluck($array, 'developer.name', 'developer.id');

//Arr::prepend 方法将数据项推入数组开头
$array = ['one', 'two', 'three', 'four'];
$array = Arr::prepend($array, 'zero');
print_r($array);
//如果需要的话还可以指定用于该值的键
$array = ['price' => 100];
$array = Arr::prepend($array, 'Desk', 'name');

//Arr::pull 方法从数组中返回并移除键值对
$array = ['name' => 'Desk', 'price' => 100];
$name = Arr::pull($array, 'name');
var_dump($name,$array);
//我们还可以传递默认值作为第三个参数到该方法，如果指定键不存在的话返回该值
//$value = Arr::pull($array, $key, $default);

//Arr::query 方法会转化数组为查询字符串
$array = ['name' => 'Taylor', 'order' => ['column' => 'created_at', 'direction' => 'desc']];
$query = Arr::query($array);
print_r($query);

//Arr::random 方法从数组中返回随机值
$array = [1, 2, 3, 4, 5];
$random = Arr::random($array);
var_dump($random);
//还可以指定返回的数据项数目作为可选的第二个参数，需要注意的是提供这个参数会返回一个数组，即使只返回一个数据项
$items = Arr::random($array, 2);

//Arr::set 方法用于在嵌套数组中使用「.」号设置值
$array = ['products' => ['desk' => ['price' => 100]]];
Arr::set($array, 'products.desk.name', '测试');
print_r($array);

//Arr::shuffle() 方法会随机打乱数组中元素的排序：
$array = Arr::shuffle([1, 2, 3, 4, 5]);
print_r($array);

//Arr::sort 方法通过值对数组进行排序
$array = ['Desk', 'Table', 'Chair'];
$sorted = Arr::sort($array);
var_dump($array,$sorted);
//还可以通过给定闭包的结果对数组进行排序
$sorted = array_values(Arr::sort($array, function ($value) {
    return $value['name'];
}));

//Arr::sortRecursive 方法使用 sort 函数对索引数组、ksort 函数对关联数组进行递归排序
$array = [
    ['Roman', 'Taylor', 'Li'],
    ['PHP', 'Ruby', 'JavaScript'],
    ['one' => 1, 'two' => 2, 'three' => 3],
];
$sorted = Arr::sortRecursive($array);

//Arr::where 方法使用给定闭包对数组进行过滤
$array = [100, '200', 300, '400', 500];
$filtered = Arr::where($array, function ($value, $key) {
    return is_string($value);
});
print_r($filtered);

//Arr::wrap 方法将给定值包裹到数组中，如果给定值已经是数组则保持不变
$string = 'Laravel';
$array = Arr::wrap($string);
print_r($array);
//如果给定值是空的，则返回一个空数组
