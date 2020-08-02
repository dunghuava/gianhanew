<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mprovinces','mdistricts']);
		$this->load->helper('unicode');
	}
	/**
	 * Index
	 */
	public function index()
	{
		$provinces = $this->mprovinces->allProvinces();
		foreach ($provinces as $key => $province) {
			$districts = $this->mdistricts->getDistrictByProvinceId($province->province_id);
			foreach ($districts as $district) {
				$this->mdistricts->update(
					array(
						'slug_name'	=> make_unicode($district->name)
					),
					array(
						'province_id' => $province->province_id,
						'district_id' => $district->district_id
					)
				);
			}
		}
		
	}
	public function create()
	{

	}
	public function update()
	{

	}
	public function destroy(){}
}

/* End of file provinces.php */
/* Location: ./application/modules/admin/controllers/provinces.php */