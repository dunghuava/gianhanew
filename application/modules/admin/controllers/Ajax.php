<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Category
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Ajax extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	* 
	*/
	public function load_ajax()
	{
		if ($this->input->is_ajax_request()) {
			$type_id = $this->input->post('type_id');
			$this->load->model('mmenus_type');
			$data = $this->mmenus_type->getMenusTypeByID($type_id);
			if (!empty($data)) {
				if ($data->type == 'articles')
				{
					$this->load->model('marticles');
					echo json_encode($this->marticles->load_ajax());
				}
				if ($data->type == 'category')
				{
					$this->load->model('mcategory');
					echo json_encode($this->mcategory->load_ajax($data->component));
				}
				if ($data->type == 'page'){
					$this->load->model('mpages');
					echo json_encode($this->mpages->load_ajax());
				}
				if ($data->type == 'contact') {
					$this->load->model('mcontacts');
					echo json_encode($this->mcontacts->load_ajax());
				}
			}
		}
	}
}