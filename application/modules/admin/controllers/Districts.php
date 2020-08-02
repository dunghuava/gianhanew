<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mdistricts','mprovinces']);
	}
	public function load_district()
	{
		if ($this->input->is_ajax_request()) {
			$provinceid = $this->input->post('province_id');
			$districts  = $this->mdistricts->getDistrictByProvinceId($provinceid);
			echo json_encode($districts);
		}else{
			redirect(base_url().$this->_data['modules']);
		}
	}
	public function index()
	{
		$this->_data['title'] = 'Danh sách Quận/Huyện';
		$this->_data['provinces'] = $this->mprovinces->allProvinces();
		$this->_data['temp'] = 'districts/index';
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
}

/* End of file districts.php */
/* Location: ./application/modules/admin/controllers/districts.php */