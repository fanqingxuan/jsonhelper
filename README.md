laravel现在是php界红的发紫的框架, 之所以红必有其道理，但个人还是感觉laravel太重了，但是laravel里面还有有一些不错的组件或者功能想移植到其他非laravel项目中去，比如Eloquent ORM，网上已经有很多资源方法教我们独立使用，这里不做介绍。laravel中内置封装了集合类，供大家处理数组使用，相信大家已经都用过了，但没有找到相关资源将集合Collection类抽取出来，为此，花了点儿时间将laravel中的Collection集合类、数组Arr类、字符串Str类抽取出来，供大家参阅以及使用。

本项目抽取了Collection、Arr、Str**类**的95%+功能，其中有一小部分没有提取，比如字符串生成uuid、获取ASCII函数，不常用切依赖别的组件，抽取出来反而使项目不够轻量级了，因此砍掉了。

### 说明

项目基于laravel最新版本7.x进行功能提取

### 环境要求

**php7.2.5+**

### 安装

```php+HTML
composer require fanqingxuan/jsonhelper 
```

### 基本用法 

```php
require_once 'vendor/autoload.php';

use JsonHelper\Collection;
use JsonHelper\Arr;
use JsonHelper\Str;

//创建集合
$collection = collect([1, 2, 3]);
print_r($collection->all());

//Arr类
//Arr::get 方法使用「.」号从嵌套数组中获取值
$array = ['products' => ['desk' => ['price' => 100]]];
$price = Arr::get($array, 'products.desk.price');
var_dump($price);

//Str类
//Str::snake 方法将给定字符串转换为形如 snake_case 格式字符串
$converted = Str::snake('fooBar');
var_dump($converted);

```

### 相关函数

本项目基本上抽取了laravel 7.x版本中Collection、Arr、Str类的所有方法，因此可以直接参考laravel 7.x手册中相关类的使用方法，可自行通过laravel官网或者其它途径查找，也可参考如下链接

[Collection函数](https://xueyuanjun.com/post/21513)

[Arr函数](https://xueyuanjun.com/post/21520#bkmrk-数组-%26-对象)

[Str函数]( https://xueyuanjun.com/post/21520#bkmrk-字符串函数)

