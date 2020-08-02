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
class Mystring
{
	public $_menu;
	
	public function __construct()
	{
		$this->_menu = NULL;
	}
	public function showMenu($parentid=0,$data = NULL)
	{
		if (isset($data) && is_array($data)) 
		{
			foreach ($data as $k => $val) 
			{
				if ($val['parent_id'] == $parentid) 
				{
					$this->_menu[$k]['id']   		= $val['id'];
					$this->_menu[$k]['path'] 		= $val['path'];
					$this->_menu[$k]['public']  	= $val['public'];
					$this->_menu[$k]['username']  	= $val['username'];
					if (isset($val['updated_at'])) {
						$this->_menu[$k]['updated_at']  	= $val['updated_at'];
					}
					$this->_menu[$k]['path_alias']  = $val['path_alias'];
					$this->_menu[$k]['title_alias'] = $val['title_alias'];
					$this->_menu[$k]['component'] 	= $val['component'];
					unset($data[$k]);
					$this->showMenu($val['id'],$data);
				}
			}
		}
		return $this->_menu;
	}
}