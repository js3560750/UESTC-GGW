<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
封装之后的上传类
*/

class Authenticator {

    /*CI的示例*/
    private $CI;

    /*使用的配置*/
    private $config;
    private $authConfig = [
        'APPID'=>"wxaf7004ad5b367b64",
        'REDIRECT_URI' => "http://www.wenyangsama.cn/Retirement/index.php/User/login",
        'SCOPE' => "snsapi_userinfo",
        'STATE' => "123",
        'APPSECRET' => "e3a8938a7d53c46453628c83a441ed9c"
    ];

    public function __construct(){
        $this->CI = &get_instance();

    }

	public function startAuthentication() {
        $url  = "https://open.weixin.qq.com/connect/oauth2/authorize?";
        $url .= "appid={$this->authConfig['APPID']}&";
        $url .= "redirect_uri=".urlencode($this->authConfig['REDIRECT_URI'])."&";
        $url .= "response_type=code&";
        $url .= "scope={$this->authConfig['SCOPE']}&";
        $url .= "state={$this->authConfig['STATE']}#wechat_redirect";


	    return $url;
    }

    public function getAccessTokenByCode($code=""){
        if($code===""){
            return "code is required!";
        }
        else{
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?";
            $url .= "appid={$this->authConfig['APPID']}&";
            $url .= "secret={$this->authConfig['APPSECRET']}&";
            $url .= "code={$code}&grant_type=authorization_code";

            @$jsonData = (array)($this->getStringFromURL($url));
            @$jsonData = (array)(json_decode($jsonData[0]));
            if(isset($jsonData['errcode'])){
                return $this->echoError($jsonData['errcode'],$jsonData['errmsg']);
            }else {
                return $jsonData;
            }
        }
    }

    public function getDetailInfo($access_token="",$openid="",$lang="zh_CN"){
        $url = "https://api.weixin.qq.com/sns/userinfo?";
        $url .= "access_token={$access_token}&";
        $url .= "openid={$openid}&";
        $url .= "lang={$lang}";

        @$jsonData = (array)($this->getStringFromURL($url));
        @$jsonData = (array)(json_decode($jsonData[0]));

        if(isset($jsonData['errcode'])){
            return $this->echoError($jsonData['errcode'],$jsonData['errmsg']);
        }else {
            return $jsonData;
        }

    }

    private function getStringFromURL($url=""){
        if($url===""){
            return "";
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
            $r = curl_exec($ch);
            curl_close($ch);
            return $r;
        }
    }

    public function echoError($errorCode=0, $message){
        $a = [
            'errorCode'=>$errorCode,
            'message'=>$message
        ];
        return ($a);
    }
}
?>