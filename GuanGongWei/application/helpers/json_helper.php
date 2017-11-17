<?php
/*
做了一个小小的封装，便于以后调整encode的选项
哈哈：这就叫封装变化点
*/

if(!function_exists('makeAndEchoWrongJson'))
{
    function  makeAndEchoWrongJson($errorCode, $message)
    {
        $info = ['errorCode'=>$errorCode,'errorMsg'=>$message];
        header('Content-type: application/json;charset=utf-8');
        echo json_encode($info , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}

//输出json，可以自己选择验证码
if(!function_exists('echoJson'))
{
    function echoJson($info, $errorCode=false)
    {
        header('Content-type: application/json;charset=utf-8');
        if($errorCode!==false){
            $info['errorCode']=$errorCode;
        }
        echo json_encode($info , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
