<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*****************************************************
*           THIẾT KẾ BỚI QHWEB.BIZ                  *
*                                                   *
*     Email:    quochieuhcm@gmail.com               *
*     Skype:    quochieuhcm                         *
*     Tel  :    0949.133.224 | 0932.600.978         *
*     Website:  www.qhweb.biz                       *
*                                                   *
*****************************************************
*/
/** application/libraries/MY_Form_validation **/ 
class MY_Form_validation extends CI_Form_validation 
{
    public $CI;
    function valid_url($str){
    	$pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
    	if (!preg_match($pattern, $str))
    	{
    		return FALSE;
    	}
    	return TRUE;
    }
    function numeric_wcomma($str)
	{
	    return preg_match('/^[0-9,]+$/', $str);
	}
}