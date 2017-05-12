# [laravel-wxxcx] package

Laravel 5 微信小程序插件

## 备注

Api | 说明 | 对应方法
---|---|---
[wx.login](https://mp.weixin.qq.com/debug/wxadoc/dev/api/api-login.html) | 登录 | $obj->getLoginInfo
[wx.getUserInfo](https://mp.weixin.qq.com/debug/wxadoc/dev/api/open.html#wxgetuserinfoobject) | 获取用户信息 | $obj->getUserInfo($encryptedData,$iv);
reference：https://mp.weixin.qq.com/debug/wxadoc/dev/api/

## 安装

执行以下命令安装最新稳定版本:

```bash
composer require vicleos/wxxcx
```

或者添加如下信息到你的 `composer.json` 文件中 :

```json
"vicleos/wxxcx": "1.*"
```

然后注册服务提供者到 Laravel中 具体位置：`/config/app.php` 中的 `providers` 数组:

```php
Vicleos\Wxxcx\WxxcxServiceProvider::class,
```
发布所需的资源(样式、视图、配置文件等): 

```bash
php artisan vendor:publish --provider="Vicleos\Wxxcx\WxxcxServiceProvider"
```
命令完成后，会添加一个`wxxcx.php`配置文件到您的配置文件夹 如 : `/config/wxxcx.php`。

生成配置文件后，将小程序的 `AppID` 和 `AppSecret` 填写到 `/config/wxxcx.php` 文件中


## Demo

共需要两步操作
1. 调用getLoginInfo得到用户信息,里面会自动封装sessionKey信息

```php
$xcx = App::make("wxxcx");
$loginInfo = $xcx->getLoginInfo($code); //code为用户登陆成功后获取到的
print_r($loginInfo);
```

reponse:
```
{
    "openid": "xxxx",
    "session_key": "xxxx"
}
```

2. 第一步操作成功后才能调用第二步, getUserInfo 会得到用户头像、昵称、等信息

```php
$iv = "r7BXXKkLb8qrSNn05n0qiA==";
$encryptedData="some code balabala....";
//sessionkey如何获取？
//请求 wx.login 接口获取到 code
//通过 appid、appscret、code 请求微信 jscode2session 接口获取 session_key
$xcx->setSessionKey("session key from wechat server api");
$userinfo = $xcx->getUserInfo($encryptedData,$iv);
print_r($userinfo);
```

reponse:
```
{
    "openId": "xxxx",
    "nickName": "Vicleos",
    "gender": 1,
    "language": "zh_CN",
    "city": "Beijing",
    "province": "Beijing",
    "country": "CN",
    "avatarUrl": "http://wx.qlogo.cn/mmopen/vi_32/xxxx",
    "unionId": "xxxxx",
    "watermark": {
        "timestamp": 1465251521,
        "appid": "your appid"
    }
}
```
# 微信小程序 Laravel
