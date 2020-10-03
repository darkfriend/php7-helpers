# PHP7-Helpers - классы хелперы, которые часто бывают полезны в разработке

``composer require darkfriend/php7-helpers``

**Структура:**

* [CurlHelper](https://github.com/darkfriend/php7-curl) - очень упрощает работу с CURL
* [DebugHelper](https://github.com/darkfriend/php7-debug) - удобный дебаггинг и трассировка данных
* [ArrayHelper](https://github.com/darkfriend/php7-array) - полезные методы при работе с массивами
* [StringHelper](https://github.com/darkfriend/php7-string) - полезные методы при работе со строками
* [TypeHelper](https://github.com/darkfriend/php7-type) - полезные методы для строгой тепизации
* [Xml](https://github.com/darkfriend/php7-xml) - полезные методы для работы с XML
* **Json** - полезные методы для работы с JSON
* **Request** - полезные методы для работы с request
* **Response** - полезные методы для работы с response
* **ErrorHelper** - помощник для ошибки
* **ReCaptchaHelper** - полезные методы для работы с Google reCaptcha
* **DateTimeHelper** - полезные хелперы для работы с датой

## Json - полезные методы для работы с JSON
```php
$json = [
    'param1' => 'value1',
    'param2' => 'value2',
    'param3' => 'value3',
];
\darkfriend\helpers\Json::encode($json); // string

$jsonString = '{"param1":"value1","param2":"value2","param3":"value3"}';
\darkfriend\helpers\Json::decode($jsonString); // array
````

## Request - полезные методы для работы с request
```php
// request body string
$body = \darkfriend\helpers\Request::getBody(); 

// get request body json
$body = \darkfriend\helpers\Request::getBodyJson();
var_dump($body); // all keys from body json
````

## Response - полезные методы для работы с response
```php
$jsonResponse = [
    'param1' => 'value1',
    'param2' => 'value2',
    'param3' => 'value3',
];
// json response
$body = \darkfriend\helpers\Response::json($jsonResponse); 
die($body);
// or response json string
\darkfriend\helpers\Response::json($jsonResponse,[
    'show' => true,
    'die' => true,
]);

// xml response
$body = \darkfriend\helpers\Response::xml($jsonResponse);
die($body);
// or response xml string
\darkfriend\helpers\Response::xml($jsonResponse,[
    'show' => true,
    'die' => true,
]);

// add header
\darkfriend\helpers\Response::setHeader([
    'Content-Type' => 'application/json',
    'Custom-Header' => 'custom header value',
]);
````

## ErrorHelper - помощник для ошибки
```php
$errors = [
    'err1' => 'error1',
    'err2' => 'error2',
    'err3' => ['error3'],
];
$errorString = \darkfriend\helpers\ErrorHelper::toStr($errors);
````

## ReCaptchaHelper - полезные методы для работы с Google reCaptcha
```php
$token = '';
$verify = \darkfriend\helpers\ReCaptchaHelper::verify($token, [
    'publicToken' => '',
    'secretToken' => '',
]);
````

## DateTimeHelper - полезные хелперы для работы с датой

#### Узнать возраст (кол-во годов)
```php
$age = \darkfriend\helpers\DateTimeHelper::getAge('1992-05-16'); // 28 (by from 3 october 2020)
// or
$age = \darkfriend\helpers\DateTimeHelper::getAge('1992-05-16', '2020-10-03'); // 28 (by from 3 october 2020)
````

#### Узнать кол-во секунд до конца дня
```php
$seconds = \darkfriend\helpers\DateTimeHelper::getAmountEndDay();
````

#### Узнать кол-во секунд между сейчас и определенной датой
```php
$endTime = strtotime("tomorrow") - 1;
$seconds = \darkfriend\helpers\DateTimeHelper::getAmountSeconds($endTime);
````