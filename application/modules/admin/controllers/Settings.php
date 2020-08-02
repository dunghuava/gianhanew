<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Setting
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Settings extends AdminController{
	public function __construct(){
		parent::__construct();
		$this->load->model('msetting');
		$this->load->library('timezonelist');
	}
	public function index(){
		redirect(base_url().'admin/settings/edit/site');
	}
	public function edit($param)
	{
		if (!isset($param))
		{
			redirect(base_url().'admin');
		}else{
			$this->_data['timezonelist'] = $this->timezonelist->toArray();
			$this->_data['title'] = 'Thiết lập cấu hình';
			$this->_data['temp'] = 'setting/'.$param;
			$setting = $this->msetting->get_setting_site_by_param($param);
			$this->_data['setting'] = ($setting['value'] != "")  ? json_decode($setting['value']) : json_decode($setting['default']);
			if ($this->input->post('btnSettingUpdate')) {
				$update = array(
					'value' => json_encode($_POST['value'],JSON_UNESCAPED_UNICODE)
				);
				$this->msetting->update($update,array('name'=>$param));
				$this->session->set_flashdata('success','Cập nhật thành công');
				redirect(base_url().'admin/settings/edit/'.$param);
			}
			$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
		}
	}
	public function reset($param){
		$update = array(
			'value' => ''
		);
		$this->msetting->update($update,array('value'=>$param));
		$this->session->set_flashdata('success','Khôi phục cấu hình mặc định thành công');
		redirect(base_url().'admin/settings');
	}
}