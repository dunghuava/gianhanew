<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends DefaultController 
{
	public function __construct()
	{
		parent::__construct();
	}
	// AJAX
	public function ajaxShowProvinces()
	{
		if ($this->input->is_ajax_request())
		{
			$this->load->model('mprovinces');
			echo json_encode($this->mprovinces->allProvinces());
		}else{
			redirect(base_url());
		}
	}
	// District
	public function ajaxShowDistricts()
	{
		if ($this->input->is_ajax_request())
		{
			$provinceID = $this->input->post('provinceID');
			if ($this->_checkValidationID($provinceID)) {
				$this->load->model('mdistricts');
				echo json_encode($this->mdistricts->getDistrictByProvinceId($provinceID));
			}else{
				echo 'Đã có lỗi xảy ra vui lòng thử lại !';
			}
		}else{
			redirect(base_url(),'refresh');
		}
	}
	// Ward
	public function ajaxShowWard()
	{
		if ($this->input->is_ajax_request())
		{
			$districtID = $this->input->post('districtID');
			if ($this->_checkValidationID($districtID)){
				$this->load->model('mward');
			echo json_encode($this->mward->getWardByDistrictId($districtID));
			}else{
				echo "Đã có lỗi xảy ra vui lòng thử lại !";
			}
		}else{
			redirect(base_url(),'refresh');
		}
	}
	// Street
	public function ajaxShowStreet()
	{
		if ($this->input->is_ajax_request())
		{
			$districtID = $this->input->post('districtID');
			if ($this->_checkValidationID($districtID))
			{
				$this->load->model('mstreets');
				echo json_encode($this->mstreets->getStreetByDistrictId($districtID));
			}else{
				echo 'Đã có lỗi xảy ra vui lòng thử lại sau';
			}
		}else{
			redirect(base_url(),'refresh');
		}
	}
	// Projects
	public function ajaxShowProject()
	{
		if ($this->input->is_ajax_request())
		{
			$districtID = $this->input->post('districtID');
			if ($this->_checkValidationID($districtID))
			{
				$this->load->model('mdistrict_projects');
				echo json_encode($this->mdistrict_projects->getProjectByDistrictId($districtID));
			}else{
				echo "Đã có lỗi xảy ra vui lòng thử lại sau !";
			}
		}else{
			redirect(base_url(),'refresh');
		}
	}
	public function ajaxshowcate()
	{
		if ($this->input->is_ajax_request()) {
			$type_id = $this->input->post('type_id');
			if ($this->_checkValidationID($type_id)){
				$this->load->model(['mcategory','mrealestate_units']);
				echo json_encode(
					array(
						'cate'  => $this->mcategory->showCategoriesByType($type_id,'realestate'),
						'units' => $this->mrealestate_units->getUnitByTypeId($type_id)
					)
				);
			}else{
				echo "Đã có lỗi xảy ra vui lòng thử lại sau !";
			}
		}else{

		}
	}
	// Validation
	public function _checkValidationID($field)
	{
		return preg_match('/^[0-9,]+$/', $field);
	}
}

/* End of file Ajax.php */
/* Location: ./application/modules/default/controllers/Ajax.php */