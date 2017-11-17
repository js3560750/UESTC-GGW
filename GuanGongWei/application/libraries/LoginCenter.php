<?php
/**
 * Created by PhpStorm.
 * User: WenYang
 * Date: 2017/4/24
 * Time: 下午3:19
 */

class LoginCenter{

    const COOKIE_SID_NAME='uestc1';
    const COOKIE_AUTH_NAME='uestc2';

    //检查管理员
    static public function adminCheck()
    {
        return self::forCheck(true);
    }

    //检查用户
    static public function userCheck()
    {
        return self::forCheck(false);
    }

    //检查用户是否登陆
    static private function forCheck($isAdmin=false)
    {
        $oldSessionStatus=session_status();	//检测之前是否调用了session_start却没有关闭
		if($oldSessionStatus != PHP_SESSION_ACTIVE){
            session_start();
        }
        if($isAdmin){
            $sessionKey='admin';    //$_SESSION数组中使用的key
        } else {
            $sessionKey='user';
        }

        $result=  false;
        if (isset($_SESSION[$sessionKey])){
            $result =  $_SESSION[$sessionKey];
        } elseif (!$isAdmin && isset($_COOKIE[self::COOKIE_AUTH_NAME]) && isset($_COOKIE[self::COOKIE_SID_NAME]) ) {    //设置了cookie并且不是管理员
            $sid = @(string)$_COOKIE[self::COOKIE_SID_NAME];
            $authKey = @(string)$_COOKIE[self::COOKIE_AUTH_NAME];
            $CI = &get_instance();
            $CI->load->database();
            $userInfo = $CI->db->select('authKey,uid,sid,headImgUrl,nickName,authTime')->get_where('user',['sid'=>$sid])->first_row('array');
            if($userInfo && $userInfo['authKey'] && $userInfo['authKey']==$authKey && (time()-(int)$userInfo['authTime'] < 3600*15) ){ //通过了验证
                unset($userInfo['authKey']);
                $_SESSION['user']=$userInfo;    //设置cookie和返回结果
                $result = $userInfo;
            }
        }

        if($oldSessionStatus != PHP_SESSION_ACTIVE){	//使用完之后，以前没有开启session的，关闭
			session_write_close();
		}
        return $result;
    }

    /**
     * 设置用户cookie
     *
     * @param int $uid
     * @return mixed
     */
    public static function setCookie($sid)
    {
        $CI = &get_instance();
        $CI->load->database();

        $randomString =function ()
        {
            $str='';
            for ($i=0; $i<20; $i++){
                $str.=chr(rand(97,122));
            }
            return $str;
        };

        //更新你数据库中的验证信息
        $authKey = $randomString();
        $CI->db->where(['sid'=>$sid])->set(['authKey'=>$authKey,'authTime'=>time()])->update('user');

        setcookie(self::COOKIE_SID_NAME,$sid,time()+3600*15,'/','',false,true);
        setcookie(self::COOKIE_AUTH_NAME,$authKey,time()+3600*15,'/','',false,true);
    }

    /**
     * 注销登录
     *
     * @return void
     */
    public static function logout()
    {
        $oldSessionStatus=session_status();	//检测之前是否调用了session_start却没有关闭
		if($oldSessionStatus != PHP_SESSION_ACTIVE){
            session_start();
        }         

        setcookie(self::COOKIE_AUTH_NAME,' ',time()-1,'/','',false,true);
        setcookie(self::COOKIE_SID_NAME,' ',time()-1,'/','',false,true);
            

        $_SESSION=array();//删除内存中的值
        setcookie(session_name(),' ',time() -1);//删除浏览器端cookie
        session_destroy();// 删除session文件和id，彻底销毁
        if($oldSessionStatus != PHP_SESSION_ACTIVE){	//使用完之后，以前没有开启session的，关闭
			session_write_close();
		}
    }
}