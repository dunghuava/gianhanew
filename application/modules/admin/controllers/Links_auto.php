<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Links_auto extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['unicode','menu']);
		$this->load->model('mlinks_auto');
	}
	/**
	 * Index
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->_data['title'] = 'Danh sách';
		$this->_data['temp']  = 'links_auto/index';
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Create
	 * @return [type] [description]
	 */
	public function create()
	{
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp']  = 'links_auto/create';
		$this->load->library('form_validation');
		$this->load->model('mcategory');
		$this->_data['category'] = $this->mcategory->get_all_categories('article');
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required|min_length[5]|max_length[12]');
		if ($this->form_validation->run() == TRUE) {
			# code...
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * update
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function update($id)
	{
		
	}

	public function destroy($id)
	{

	}
}

/* End of file Links_auto.php */
/* Location: ./application/modules/admin/controllers/Links_auto.php */