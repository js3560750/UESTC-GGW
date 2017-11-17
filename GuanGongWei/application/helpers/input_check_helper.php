<?php
/*
用于表单验证

function setFormRules() : 传入简单版本的数组（不用指明filed、label那种key），返回CI表单验证类需要的数组，添加对对个规则对应同一错误的支持，如果错误信息前不带错误码，会自动设置错误码为100

function checkFormErrors() : 验证并获得错误信息（可能包含多个），无错误时，返回空数组

function ajaxToPost()： 将ajax的$_POST['data']json_decode之后压入POST数组，返回true说明成功，false说明不是ajax请求或者请求格式错误

*/
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('setFormRules') )
{
    function setFormRules($patterns)
    {   
        $patternsDone =[];    //处理过的数组
        $index = 0; //$patternsDone的index
        foreach ($patterns as $pattern){
            $patternsDone[$index]=[
                'field'=>$pattern[0],
                'label'=>$pattern[1],
                'rules'=>$pattern[2]
            ];
            if (isset($pattern[3])){

                //本函数用于将error中的required|min_length|max_length分割成单个的string，去掉'|'，因为CI原生不支持
                $devideErrorKeyFunc = function (string $string, int $strCount){
                    $strArray = [];
                    while($strCount>0){
                        $location = strpos($string,'|');
                        $strArray[]=substr($string,0,$location);                        
                        $string = substr_replace($string, '', 0, $location+1);
                        $strCount--;
                    }

                    $strArray[]=$string;
                    return $strArray;
                };

                foreach($pattern[3] as $key => $error){
                    //检测error里是否有errorCode前缀，没有就默认为100
                    if(!strpos($error,'_')){
                        $error = '100_'.$error;
                    }

                    //检测是否有空个
                    if (strpos($key,' ') !== false ){
                        show_error('Form Validation Error：your errors key pattern contsins space', 'Form Validation Error');

                    }

                    //添加对'min_length|max_length'=>'error Info'这类多个规则对应同一错误信息的功能
                    $strCount = substr_count($key, '|');   
                    if($strCount){
                        $errorKeys = $devideErrorKeyFunc($key, $strCount);
                        foreach ($errorKeys as $value){
                            $pattern[3][$value]=$error;
                        }
                        unset($pattern[3][$key]);
                    }
                    $pattern[3][$key]=$error;

                }
                $patternsDone[$index]['errors']=$pattern[3];
            }
            if (strpos($pattern[2],'required') !== false) {
                $patternsDone[$index]['errors']['required']='11_{field} is needed';
            }
            $index++;
        }

        $CI = &get_instance();
        $CI->form_validation->set_rules($patternsDone);

    }

}


if (!function_exists('checkFormErrors'))
{
    function checkFormErrors()
    {
        $errorReturn=[];    //用于返回的数组
        $CI = &get_instance();
        if ($CI->form_validation->run()){   //验证
            return $errorReturn;
        }
        $errors = $CI->form_validation->error_array();  //有错误、获得错误信息

        if(!$errors){
            return [['errorCode'=>1,'errorMsg'=>'Server Error']];
        }

        foreach ($errors as $key => $error){
            $location = strpos($error,'_');
            if (!$location){
                echo $error;
                show_error('Form Validation Error：where is your "_" in '.$error, 'Form Validation Error');
            }

            $errorCode = (int)substr($error,0,$location);   //将错误信息前边的前缀（如'101_')转换为int错误码
            $errorMsg = substr($error,$location+1);
            $errorReturn[]=[    //返回所有的错误
                'errorCode'=>$errorCode,
                'errorMsg'=>$errorMsg,
                'field'=>$key
            ];
        }

        return $errorReturn;
    }
}


if (!function_exists('ajaxToForm'))
{
    function ajaxToForm()
    {
       $isAjax = function (){
			return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
		};

        if (!$isAjax()) {
            return ['errorCode'=>11,'errorMsg'=>'不是ajax请求'];
        }

        if(array_key_exists('data', $_POST)){
            $data = json_decode($_POST["data"], true);
            $_POST = $data;
            return true;
        } else {
            return ['errorCode'=>11,'errorMsg'=>'提交ajax的post名称错误'];
        }
    }
}


/*//获得请求的某个指定字段之后再决定表单的验证情况,传入的是引用
dead function !!
if (!function_exists('ajaxToFormAndGetType'))
{
    function ajaxToFormAndGetType(&$type, $typeKey='type')
    {
        $result = ajaxToForm();
        if(!array_key_exists($tyeKey,$_POST)){
            show_error('ajaxToFormAndGetType can not find your type:'.$type, 'InputCheck Error');
        } else {
            $type = $_POST[$typeKey];
        }
        return $result;
    }
}*/