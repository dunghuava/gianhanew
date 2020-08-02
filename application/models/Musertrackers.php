<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Users
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com or thietkeweb.qh@gmail.com | 0949.133.224
* @copyright @2015
*/
class Musertrackers extends MY_Model
{
	protected $table_name='usertrackers';

	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function getAllUserTrackers()
	{
		$this->db->select('usertrackers.*, users.username');
		$this->db->join('users', 'users.id = usertrackers.user_id');
		$this->db->order_by('usertrackers.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
}