<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21
 * Time: 20:35
 */

if(!function_exists('deteleImage')){

    function deleteImage($path){
        if(file_exists($path)){
            unlink($path);
        }
    }
}