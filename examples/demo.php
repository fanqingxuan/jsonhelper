<?php
require_once '../vendor/autoload.php';

use JsonHelper\Collection;
use JsonHelper\Arr;
use JsonHelper\Str;

//创建集合
$collection = collect([1, 2, 3]);
print_r($collection->all());
var_dump($collection->toJson());

//Arr类
//Arr::get 方法使用「.」号从嵌套数组中获取值
$array = ['products' => ['desk' => ['price' => 100]]];
$price = Arr::get($array, 'products.desk.price');
var_dump($price);

//Str类
//Str::snake 方法将给定字符串转换为形如 snake_case 格式字符串
$converted = Str::snake('fooBar');
var_dump($converted);