<?php

/* Simple configuration file for Laravel Xcx package */
return [
    'appid' => 'your AppID',
    'secret' => 'your AppSecret',
    'code2session_url' => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
];
