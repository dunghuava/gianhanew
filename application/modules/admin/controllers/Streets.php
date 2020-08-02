<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streets extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('unicode');
		$this->load->model('mstreets');
	}
	public function index($provinceID, $districtID)
	{
		if (!isset($provinceID) || !is_numeric($provinceID) || !isset($districtID) || !is_numeric($districtID)) {
			redirect(base_url().$this->_data['modules'].'/districts/index');
		}
		$check_province = $this->db->where('province_id', $provinceID)->get('provinces')->row();
		if (empty($check_province)) {
			$this->session->set_flashdata('error', 'Không tồn tại tỉnh / Thành phố . Vui lòng chọn lại');
			redirect(base_url().$this->_data['modules'].'/districts/index');
		}
		$check_district_in_province = $this->db->where('province_id', $provinceID)->get('districts')->row();
		if (empty($check_district_in_province)) {
			$this->session->set_flashdata('error', 'Không tồn tại quận này trong '.$check_province->type. ' ' . $check_province->name);
			redirect(base_url().$this->_data['modules'].'/districts/index');
		}
		// All ok
		$roads = $this->mstreets->getStreetByDistrictId($districtID);
		$this->_data['title'] 	  = 'Tuyến đường '.$check_district_in_province->pre . ' ' . $check_district_in_province->name;
		$this->_data['temp']  	  = 'streets/index';
		$this->_data['roads']     = $roads;
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function create($provinceID, $districtID)
	{
		if (!isset($provinceID) || !is_numeric($provinceID) || !isset($districtID) || !is_numeric($districtID)) {
			redirect(base_url().$this->_data['modules'].'/districts');
		}
		$check_province = $this->db->where('province_id', $provinceID)->get('provinces')->row();
		if (empty($check_province)) {
			$this->session->set_flashdata('error', 'Không tồn tại tỉnh / Thành phố . Vui lòng chọn lại');
			redirect(base_url().$this->_data['modules'].'/districts');
		}
		$check_district_in_province = $this->db->where('province_id', $provinceID)->get('districts')->row();
		if (empty($check_district_in_province)) {
			$this->session->set_flashdata('error', 'Không tồn tại quận này trong '.$check_province->type. ' ' . $check_province->name);
			redirect(base_url().$this->_data['modules'].'/districts');
		}
		// ALL OK
		$this->_data['title'] 	  = 'Thêm mới';
		$this->_data['temp']  	  = 'streets/create';
		$this->load->helper('unicode');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'tên đường', 'trim|required|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$street = [
				'name' => $this->input->post('name'),
				'street_slug' => make_unicode($this->input->post('name')),
				'district_id'=> $districtID
			];
			$this->mstreets->insert($street);
			$this->session->set_flashdata('success', 'Thêm mới đường '.$this->input->post('name'));
			redirect(base_url().$this->_data['modules'].'/streets/index/'. $provinceID .'/'. $districtID);
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
}

/* End of file Streets.php */
/* Location: ./application/modules/admin/controllers/Streets.php */