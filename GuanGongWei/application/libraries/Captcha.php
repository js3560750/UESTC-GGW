<?php

/*
验证码类
*/
class Captcha
{
    private $width;
    private $height;
    //验证码数目
    private $codeNum;
    //文字代码
    private $code;
    private $im;
    private $fontFile=false;

    public function __construct($width = 80, $height = 30, $codeNum = 4, $ziti = APPPATH.'font/ziti.ttf')
    {
        $this->width = $width;
        $this->height = $height;
        $this->codeNum = $codeNum;
		$this->fontFile = $ziti;
    }

    public function showImg($type)
    {

		$this->createCode();
		$oldSessionStatus=session_status();	//检测之前是否调用了session_start却没有关闭
		if($oldSessionStatus != PHP_SESSION_ACTIVE){
			session_start();
		}
		$_SESSION['captcha'][$type]=$this->code;
		if($oldSessionStatus != PHP_SESSION_ACTIVE){	//使用完之后，以前没有开启session的，关闭
			session_write_close();
		}
        //创建图片
        $this->createImg();
        //设置干扰元素
        $this->setDisturb();
        //设置验证码
        $this->setImageCode();
        //输出图片
        $this->outputImg();
    }


	/**
	 * check 检测验证码是否正确
	 * 
	 * @param string $code 传入的验证码
     * @param string $type 指明是网站的阿哥地方使用了验证码
	 * @param bool $setPassed 是否设置验证码通过的标志captchaPasswed
	 * @return mixed
	 */
	public function preCheck($code, $type, $setPassed=true){
		$oldSessionStatus=session_status();	//检测之前是否调用了session_start却没有关闭
		if($oldSessionStatus != PHP_SESSION_ACTIVE){
			session_start();
		}
		if(!isset($_SESSION['captcha'][$type])){
			$return =false;
		}elseif(strtoupper($_SESSION['captcha'][$type])==strtoupper($code)){
			$return=true;
            if($setPassed){
                $_SESSION['captchaPassed'][$type]=true;    //标记本验证码已经通过                
            }
			unset($_SESSION['captcha'][$type]);
		}else{      //输入了验证码，但是错误了，销毁该验证码，只有一次机会
			$return=false;
			unset($_SESSION['captcha'][$type]);
		}
		if($oldSessionStatus != PHP_SESSION_ACTIVE){	//使用完之后，以前没有开启session的，关闭
			session_write_close();
		}
		return $return;
	}


    //共其他模块调用，检测验证码是否通过
    public function check($code, $type)
    {
        $oldSessionStatus=session_status();	//检测之前是否调用了session_start却没有关闭
		if($oldSessionStatus != PHP_SESSION_ACTIVE){
			session_start();
		}
        if(isset($_SESSION['captchaPassed'][$type])){
            unset($_SESSION['captchaPassed'][$type]);
            $return =  true;
        }elseif(isset($_SESSION['captcha'][$type])){
            return $this->preCheck($code,$type,false);   //不要设置验证通过的标志，这是防止前端的ajax提交判断验证码失效
        }else{
            $return = false;            
        }
        if($oldSessionStatus != PHP_SESSION_ACTIVE){	//使用完之后，以前没有开启session的，关闭
			session_write_close();
		}
		return $return; 
    }

    public function setFontFile($file)
    {
        $this->fontFile=$file;
    }

    private function createImg()
    {
		$this->im = imagecreatetruecolor($this->width, $this->height);
		$bgColor = imagecolorallocate($this->im, 255, 255, 255);
		imagefill($this->im, 0, 0, $bgColor);
    }

    private function setDisturb()
    {
		$area = ($this->width * $this->height) / 40;
		$disturbNum = ($area > 250) ? 250 : $area;
            //加入点干扰
        for ($i = 0; $i < $disturbNum; $i++) {
            $color = imagecolorallocate($this->im, 30, 144, 255);
            imagesetpixel($this->im, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);
        }
            //加入弧线
        for ($i = 0; $i <= 5; $i++) {
            $color = imagecolorallocate($this->im, 30, 144, 255);
            imagearc($this->im, rand(0, $this->width), rand(0, $this->height), rand(30, 300), rand(20, 200), 50, 30, $color);
        }
    }

    private function createCode()
    {
		$str = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ';
		$this->code='';
		$strLen=strlen($str);
        for ($i = 0; $i < $this->codeNum; $i++) {
            $this->code .= $str{rand(0, $strLen - 1)};
        }
    }

    //将文字验证码填入图片
    private function setImageCode()
    {
        for ($i = 0; $i < $this->codeNum; $i++) {
            $color = imagecolorallocate($this->im, 30, 144, 255);
            $x = floor($this->width / $this->codeNum) * $i +3;
            $y = $this->height/2+9;
            if ($this->fontFile) {
                $angle=rand(0, 30);	//角度
                imagettftext($this->im, 20, $angle, $x, $y, $color, $this->fontFile, $this->code{$i} );
            } else {
                imagechar($this->im,10, $x, $y, $this->code{$i}, $color);
            }
        }
    }

    //输出图片
    private function outputImg()
    {
        if (imagetypes() & IMG_JPG) {
            header('Content-type:image/jpeg');
            imagejpeg($this->im);
        } elseif (imagetypes() & IMG_GIF) {
            header('Content-type: image/gif');
            imagegif($this->im);
        } elseif (imagetype() & IMG_PNG) {
            header('Content-type: image/png');
            imagepng($this->im);
        } else {
            return false;
        }
    }

//class ed 
}
