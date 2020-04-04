<?php
require_once '../vendor/autoload.php';

use JsonHelper\Str;

//Str::after 方法返回字符串中给定值之后的所有内容
var_dump(Str::after('This is my name', 'This is'));

//Str::afterLast 方法会返回字符串中给定值最后一次出现位置之后的所有字符，如果该值在字符串中不存在则返回整个字符串
$slice = Str::afterLast('App\Http\Controllers\Controller', '\\');
var_dump($slice);

//Str::before 方法返回字符串中给定值之前的所有内容
$slice = Str::before('This is my name', 'my name');
var_dump($slice);

//Str::beforeLast 方法会返回字符串中给定值最后一次出现位置之前的所有字符
$slice = Str::beforeLast('This is my name', 'is');
var_dump($slice);

//Str::camel 将给定字符串转化为形如 camelCase 的驼峰风格
$converted = Str::camel('foo_bar');
var_dump($converted);

//Str::contains 方法判断给定字符串是否包含给定值（大小写敏感）
$contains = Str::contains('This is my name', 'my');
var_dump($contains);
//还可以传递数组值判断给定字符串是否包含数组中的任意值,只要有一个包含就返回true
$contains = Str::contains('This is my name', ['my', 'foo']);

//Str::containsAll 方法用于判断给定字符串是否包含所有数组值
$containsAll = Str::containsAll('This is my name', ['my', 'name']);
print_r($containsAll);

//Str::endsWith 方法用于判断字符串是否以给定值结尾
$result = Str::endsWith('This is my name', 'name');
var_dump($result);
//你还可以传递数组来判断给定字符串是否以数组中的任意值作为结尾
//$result = Str::endsWith('This is my name', ['name', 'foo']);   --true
//$result = Str::endsWith('This is my name', ['this', 'foo']);  --false

//Str::finish 方法添加给定值单个实例到字符串结尾 —— 如果原字符串不以给定值结尾的话
$adjusted = Str::finish('this/string', '/');
var_dump($adjusted);
$adjusted = Str::finish('this/string/', '/');
var_dump($adjusted);

//Str::is 方法判断给定字符串是否与给定模式匹配，星号可用于表示通配符
$matches = Str::is('foo*', 'foobar');

//Str::ucfirst() 方法会以首字母大写格式返回给定字符串
$string = Str::ucfirst('foo bAr');
print_r($string);

//Str::isUuid()方法会判断给定字符串是否是有效的 UUID
$isUuid = Str::isUuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');

//Str::kebeb 方法将给定字符串转化为形如 kebab-case 风格的字符串
$converted = Str::kebab('fooBar');
var_dump($converted);

//Str::limit 方法以指定长度截断字符串
$truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20);
var_dump($truncated);
//还可以传递第三个参数来改变字符串末尾字符：
$truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20, ' (...)');

//Str::plural 方法将字符串转化为复数形式，该函数当前只支持英文
$plural = Str::plural('child');
var_dump($plural);
//还可以传递整型数据作为第二个参数到该函数以获取字符串的单数或复数形式
$plural = Str::plural('child', 2);// children
$plural = Str::plural('child', 1);//child

//Str::random 方法通过指定长度生成随机字符串，该函数使用了PHP的 random_bytes 函数
$random = Str::random(40);
var_dump($random);

//Str::replaceArray 方法使用数组在字符串序列中替换给定值
$string = 'The event will take place between ? and ?';
$replaced = Str::replaceArray('?', ['8:30', '9:00'], $string);
// The event will take place between 8:30 and 9:00
print_r($replaced);

//Str::replaceFirst 方法会替换字符串中第一次出现的值
$replaced = Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');
// a quick brown fox jumps over the lazy dog

//Str::replaceLast 方法会替换字符串中最后一次出现的值
$replaced = Str::replaceLast('the', 'a', 'the quick brown fox jumps over the lazy dog');

//Str::singular 方法将字符串转化为单数形式，该函数目前只支持英文
$singular = Str::singular('cars');// car

//Str::snake 方法将给定字符串转换为形如 snake_case 格式字符串
$converted = Str::snake('fooBar');
var_dump($converted);

//如果字符串没有以给定值开头的话 Str::start 方法会将给定值添加到字符串最前面
$adjusted = Str::start('this/string', '/');// /this/string
$adjusted = Str::start('/this/string', '/');// /this/string

//Str::startsWith 方法用于判断传入字符串是否以给定值开头
$result = Str::startsWith('This is my name', 'This');

//tr::studly 方法将给定字符串转化为形如 StudlyCase 的、单词开头字母大写的格式
$converted = Str::studly('foo_bar');
var_dump($converted);

//Str::title 方法将字符串转化为形如 Title Case 的格式
$converted = Str::title('a nice title uses the correct case');

//Str::words() 方法会限制字符串单词个数
$converted = Str::words('Perfectly balanced, as all things should be.', 3, ' >>>');
var_dump($converted);