<?php
/**

*将资源的位置转化为访问的url
*@param location 文件的完整路径，将其转化为访问的url
*/


defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('fileUrl') )
{
    function fileUrl($location)
    {
        $str = str_replace($_SERVER['DOCUMENT_ROOT'], '', $location);
        return $str;
    }

}


if ( ! function_exists('deleteFile') )
{
    function deleteFile($file,$callerName='unKnow')
    {
        if(!@unlink($file)){
            log_message('error','delete file failed, path'.$file.' called by:'.$callerName);
            return false;
        }
        return true;
    }

}




/*

//从数据库中的url得到真实的文件地址
//这个函数需要控制图片在statics目录下，防止编辑人员传入恶意图片地址
if ( ! function_exists('getPathFromUrl') )
{
    function getPathFromUrl($url)
    {
        return UESTC_STATICS_PATH.substr($url,9);   //获得真实的地址
    }

}

//事务代办获得应该存在数据库中的地址
if ( ! function_exists('getAgentDbLocation') )
{
    function getAgentDbLocation($fullPath)
    {
        return str_replace(APPPATH.'statics/agentUser/','',$fullPath);
    }

}

//事务代办文件从数据库location获得完整的地址
if ( ! function_exists('getAgentFullPathFromDb') )
{

    function getAgentFullPathFromDb($dbLocation)

    {
        return APPPATH.'statics/agentUser/'.$dbLocation;
    }


}
*/

