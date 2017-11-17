<?php
/**
 * Author: WenYang
 * Date: 2017/5/9
 * Time: 上午11:14
 *
 * 用于密码加密和验证
 * function encrypt_password() : 摘要密码算法，传入加密内容，加密算法和盐值，返回密文
 *
 */

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('encrypt_password') )
{
    /**
     * @name encrypt_password
     * @author WenYang
     * @const PASSWORD_SALT 注意在config/constants/文件夹中定义PASSWORD_SALT
     * @param string $password 需要加密的内容
     * @param string $algo  使用的算法 { MD5, SHA256 }
     * @param string $salt  盐值
     * @return mixed
     */
    function encrypt_password($password, $algo="SHA256", $salt=PASSWORD_SALT)
    {
        if(!isset($password)) return FALSE;

        $data = $password.$salt;
        switch ($algo){
//            case 'MD5':
//                return hash('md5', $data, FALSE);
//                break;
            case 'SHA256':
                return hash('sha256', $data, FALSE);
                break;
        }
    }
}

if ( ! function_exists('varify_password') )
{
    function varify_password($password, $hashed_password, $algo="SHA256", $salt=PASSWORD_SALT)
    {
        $data = $password.$salt;

        switch ($algo){
//            case 'MD5':
//                return hash('md5', $data, FALSE) === $hashed_password;
//                break;
            case 'SHA256':
                return hash('sha256', $data, FALSE) === $hashed_password;
                break;
        }
    }
}