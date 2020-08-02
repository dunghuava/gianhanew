<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Setting
* 

* @copyright 2015
*/
class Msetting extends MY_Model
{
	protected $table_name = 'settings';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function get_setting_site(){
		return $this->db->where('name','site')
						->get($this->table_name)
						->row_array();
	}
	public function get_setting_site_by_param($param){
		return $this->db->where('name',$param)
						->get($this->table_name)
						->row_array();
	}
}