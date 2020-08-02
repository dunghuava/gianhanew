<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Captcha{
	public function make_captcha()
	{
		$CI     = & get_instance();
		$CI->load->helper('string');
		$str    = random_string('numeric',5);
        $CI->session->set_userdata('captcha',$str);
		$width  = 90;
		$height = 30;
		$image  = ImageCreateTrueColor($width,$height);
		$text   = ImageColorAllocate($image, 255, 255, 255);
		$bg     = imagecolorallocate($image, 76, 110, 148);
		imagefilledrectangle($image, 0, 0, $width, $height, $bg);
		imagestring($image, 5, 21, 7, $str, $text);
		ob_start();
		imagejpeg($image);
		$jpg = ob_get_clean();
		return "data:image/jpeg;base64," . base64_encode($jpg);		
	}
}