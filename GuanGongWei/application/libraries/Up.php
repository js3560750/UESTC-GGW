<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$childFile = date('ym');

/*
封装之后的上传类
*/

class Up {

    /*CI的示例*/
    private $CI;

    /*使用的配置*/
    private $config;

    public function __construct(){
        $this->CI = &get_instance();
    }

    /*salary表格提交*/
    public function salary(){
        return $this->doUpload('salary');
    }

    /*文章附件*/
    public function image(){

        $fileInfo =  $this->doUpload('imageTemp', 'file');
        if($fileInfo['errorCode']==0){ //如果上传正常，还需要检测是否需要压缩，超过500
            if(filesize($fileInfo['fullPath'])>200*1024){   //图片大于200k
                $this->compressImage($fileInfo['fullPath']);
            }
        }
        return $fileInfo;
    }

    /*移动临时附件到正确的位置,并返回文件的url*/
    public function mvImageAndGetUrl($fullPathArray){
        $return=[];
        foreach($fullPathArray as $key => $value){
            $path = str_replace('upload/image/tmp/','upload/image/',$value);
            $folderName=dirname($path);
            //print_r($folderName);die;
            if(!file_exists($folderName)){  //建立文件夹
                mkdir($folderName,0777,true);
            }
            rename($value,$path);   //移动文件
            $this->CI->load->helper('file_url');
            $return[$key]=fileUrl($path);
        }
        return $return;
    }


    /*载入CI的上传library并上传
    dataName：上传文件的名称，默认为upfile，多文件上传的时候会变
    */
    private function doUpload($strKind, $dataNAme='file'){

        if(!isset($this->CI->upload)){  //还没有载入上传类
            //取得上传的配置文件
            $this->CI->config->load('up',true);
            $this->config = $this->CI->config->item('up')[$strKind];
            $this->CI->load->library('upload',$this->config);
        }

        //设置上传的文件名
        $randomCharsFunc=function(){
            $str='';
            for($i=0;$i<5;$i++){
                $str.=chr(rand(97,122));
            }
            return $str;
        };
        $upRandStr = $randomCharsFunc();
        $this->config['file_name']=time().$upRandStr;   //制定文件名

        //文件夹不存在创建一个
        if(!file_exists($this->config['upload_path'])){
            mkdir($this->config['upload_path'],0777,true);
        }
        
        $this->CI->upload->initialize($this->config);   //重新设置文件名

        $return = [];   //用于返回的数组
        if (!$this->CI->upload->do_upload($dataNAme)){
            
            $CIMessage = $this->CI->upload->display_errors('','');   //获得错误信息
            //echo $CIMessage;
            if(strpos($CIMessage,'阿偶～')!==false){  //有阿偶的是用户造成的错误
                $return['errorCode']=100;
                $errorMsg=$CIMessage;
            }elseif(strpos($CIMessage,'前端的锅')){
                $return['errorCode']=11;
                $errorMsg=$CIMessage;
            }elseif($CIMessage == 'The filetype you are attempting to upload is not allowed.'){
                if ($strKind == 'image') {
                    $errorMsg = '您只能上传10m以下的 gif、jpg、png、bmp图片';
                    $return['errorCode']=100;
                }elseif($strKind == 'salary'){
                    $errorMsg = '您只能上传10m以下的xls、xlsx文件';
                    $return['errorCode']=100;
                }
            }else{
                //adminWarning($CIMessage);   //提供管理员
                $return['errorCode']=100;
                $errorMsg = '服务器错误，请再试一次后请及时联系管理员';
            }
            $return['errorMsg'] = $errorMsg;
            
        } else {    //没有出错
            $this->CI->load->helper('file_url');
            $path = $this->CI->upload->data('full_path');
            $fileName = htmlspecialchars($_FILES[$dataNAme]['name'],ENT_QUOTES);       //文件名转义
            $return = ['errorCode'=>0, 'fullPath'=>$path, 'fileName'=>$fileName ,'url'=>fileUrl($path) ];
		}
        return $return;
    }


    //压缩图片
    private function compressImage($imgPath)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $imgPath;
        $config['maintain_ratio'] = TRUE;   //保持原比例
        list($width, $height) = getimagesize($imgPath);
        $changKuanBi = $height/$width;
        if($changKuanBi > 2){   //说明有可能是长图，根据宽度的比例来确定长度压缩比例
            //限制宽度700
            $percent=700/$width;
            if($percent >= 1){
                $percent=0.9;
            }
            $config['width']=$percent*$width;
            $config['height']=$percent*$height;
        }else{
            //限制像素
            if($width/1000 > 1 || $height/1000 >1){
                $config['width']=1000;
                $config['height']=1000;
            }else{  //像素没有限制住，使用百分比
                $percent=0.9;
                $config['width']=$percent*$width;
                $config['height']=$percent*$height;
            }
        }
        //}
        $this->CI->load->library('image_lib', $config);
        $this->CI->image_lib->resize();
    }


}