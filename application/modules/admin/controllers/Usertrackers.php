<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertrackers extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('musertrackers');
	}
	public function index()
	{
		$this->_data['title'] = 'Lịch sử đăng nhập';
		$this->_data['temp']  = 'usertrackers/index';
		$this->_data['usertrackers'] = $this->musertrackers->getAllUserTrackers();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	//destroy
	public function destroy($id)
	{
		if (!is_numeric($id) && !isset($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra. Vui lòng thử lại sau');
			redirect(base_url().$this->_data['modules'].'/usertrackers');
		}
		$this->musertrackers->delete(['id'=>$id]);
		$this->session->set_flashdata('success', 'Xóa thành công !');
		redirect(base_url().$this->_data['modules'].'/usertrackers');
	}

}

/* End of file usertrackers.php */
/* Location: ./application/modules/admin/controllers/usertrackers.php */