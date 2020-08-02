<?php
if (!function_exists('make_unicode')) {
	function make_unicode($str){
		$str = trim(mb_strtolower($str));
		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str = preg_replace('/(đ)/', 'd', $str);
		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str = preg_replace('/([\s]+)/', '-', $str);
		return $str;
	}
}
function unicode2($str){
	if(!$str) return false;
	$unicode = array(
		'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),
		'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
		'd'=>array('đ'),
		'D'=>array('Đ'),
		'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
		'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
		'i'=>array('í','ì','ỉ','ĩ','ị'),
		'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
		'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),
		'0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
		'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),
		'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
		'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
		'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
		'' =>array('"',":","?","!",'-','  ')
	);
	foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
			$str = str_replace($value,$nonUnicode,$str);
	}
	$str=strtolower($str);
	return $str;
}
function get_random_string($valid_chars, $length){
	$random_string = "";
	$num_valid_chars = strlen($valid_chars);
	for ($i = 0; $i < $length; $i++){
		$random_pick = mt_rand(1, $num_valid_chars);
		$random_char = $valid_chars[$random_pick-1];
		$random_string .= $random_char;
	}
	return $random_string;
}
function convert_file_to_date($file,$title)
{
	$string     = '0123456789';
	$file       = preg_replace("/\s+/", "_", $file);
	$tmp        = explode(".", $file);
	$extension  = end($tmp);
	$menu_image = $title.'-'.get_random_string($string, 4)."-".date("Y-m-d").".".$extension;
	return $menu_image;
}
function stripString($string,$lenght, $string_end =' [...]' ) 
{
	if(strlen($string)<=$lenght){
		return $string; 
	} 
	else { 
		if(strpos($string," ",$lenght) > $lenght){
			$new_lenght= strpos($string," ",$lenght); 
			$new_chuoi = substr($string,0,$new_lenght).$string_end; 
			return $new_chuoi; 
		} 
		$new_chuoi = substr($string,0,$lenght).$string_end; return $new_chuoi; 
	} 
}
if (!function_exists('getThumbnail')){
	function getThumbnail($realestateID,$thumbnails=null)
	{
		$CI =& get_instance();
		$thumb = $CI->db->select('realestate_gallerys.title, realestate_gallerys.image, realestates.created_at')
						->join('realestates','realestate_gallerys.realestate_id = realestates.id')
						->where('realestate_gallerys.realestate_id',$realestateID)
					    ->order_by('realestate_gallerys.created_at','asc')
					    ->limit(1)
					    ->get('realestate_gallerys')
					    ->row();
		if (!empty($thumb)){
			if ($thumbnails == null) {
				return date('Y',strtotime($thumb->created_at)).'/'.date('m',strtotime($thumb->created_at)).'/'.date('d',strtotime($thumb->created_at)).'/'.$thumb->image;
			}else{
				return date('Y',strtotime($thumb->created_at)).'/'.date('m',strtotime($thumb->created_at)).'/'.date('d',strtotime($thumb->created_at)).'/thumbnails/'.$thumbnails.$thumb->image;
			}
			
		}else{
			return 'no_image.jpg';
		}
	}
}
if(!function_exists('get_slug_project'))
{
    function get_slug_project($project_id)
    {
        $CI =& get_instance();
        $project = $CI->db->select('project_id,project_slug,project_name')
        				  ->where('project_id',$project_id)
        				  ->get('projects')
        				  ->row();
        if(!empty($project)){
            return $project;
        }   
    }
}