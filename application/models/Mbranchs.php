<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbranchs extends MY_Model {
	public $rules = array(
		'insert' => array(
			'title'	=> array(
				'field'=>'title',
				'label'=>'tên đối tác',
				'rules'=>'trim|required'
			),
			'image'	=> array(
				'field'=>'image',
				'label'=>'hinh ảnh',
				'rules'=>'trim|required'
			),
			'website'	=> array(
				'field'=>'website',
				'label'=>'<b>tên website</b>',
				'rules'=>'valid_url'
			)
		)
	);
	protected $table_name = 'branchs';
	public function __construct()
	{
		parent::__construct();
	}
	public function getBranchs()
	{
		return $this->db->select('branchs.id,branchs.image,branchs.title,branchs.params,branchs.created_at,users.username')
						->join('users', 'users.id = branchs.created_by')
						->get($this->table_name)
						->result_array();
	}
	public function get_branch($id)
	{
		return $this->db->where('id',$id)
						->get($this->table_name)
						->row();
	}
	/**
	 * 
	 */
	public function getAllBrachs()
	{
		return $this->db->select('branchs.image,branchs.title,branchs.params')
						->get($this->table_name)
						->result();
	}
}

/* End of file mbranchs.php */
/* Location: ./application/models/mbranchs.php */