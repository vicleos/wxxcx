<?php

class WxxcxTest extends TestCase
{
    protected $wxxcx;


    public function setUp()
    {
        parent::setUp();

        // config
        $config = [
            'appid' => 'your appid',
            'secret' => 'your appsecret',
            'code2session_url' => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
        ];

        $this->wxxcx = new Vicleos\Wxxcx\Wxxcx($config);
    }


    public function testGetUserInfo()
    {
        $xcx = \Illuminate\Support\Facades\App::make("wxxcx");
        //来自于wx.getUserInfo的请求结果
        $encryptedData="FVpMJr/JALHK2cS1xyhtki1aqgEvsBhu+zQu6k1OCSI3utxr1rNH88j3eGOe22dEeBVfvS/YoHbRvojtN6nRjsfMKzeg++EOSpNMX16f9zOqdc6uyTzw8nop7/Fuso5U6mkRQ9SqcQ+SUXRbXD8Imb+MM1pIsXF1M5/EofXUDIf8nOvm3YVF+zhLCkOxEX1LuaFOEfK1togu6JwerKNYst+CeI3/NgkmTcJJ0aE1p2cM+8SRG/Tzj2L4S8xUHWMrPePgkvhDrvkMhJUn/JwL4F5xP4/1K6u9bbCQeAQm0uQA/fUpsXuD4Cp+sDpE0B3zv/znBo/GZitPzgU7lBsq6F4LstcgPMYsjUgH23uOHROpWdLS5SSn/zt3h8iNqb8ktcj58lJyJlPXWip9Ikrb85hWAvtLN50yAEW4u65K6/MGFJw426Aslv7A4xoVb5gRYfoIXeNJsTKIhEKiX/Hs9PDf7DScba5STaoAqXXpeFDGAUQOmHGsbvLGoKBqI5Dtq0/v+mXNVbsTOVRdng9o4Q==";

        $iv = 'YlaRVOv/v64nM3xayX7iVw==';
        $userinfo = $xcx->getUserInfo($encryptedData,$iv);
        $userArr = json_decode($userinfo,true);
        $this->assertEquals('your openId', $userArr["openId"]);
    }

}
