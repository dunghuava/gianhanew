<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
	}
	public function index(){
		$this->_data['title'] = 'Tài khoản người dùng';
		$this->_data['temp']  = 'users/edit';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password_old', 'mật khẩu cũ', 'required');
		$this->form_validation->set_rules('password_new', 'mật khẩu mới', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'confirm mật khẩu mới', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			// Check Password TRUE or False
			$userID = $this->session->userdata('user_id');
			$this->load->helper('security');
			$password = md5(sha1($this->input->post('password_old')));

			$users = $this->musers->check_password_old($userID,$password);
			
			if ($users) {
				$data = array(
					'password'=> md5(sha1($this->input->post('password_new')))
				);
				$this->musers->update($data,array('id'=>$userID));
				$this->session->set_flashdata('success', 'Thay đổi thông tin thành công ! Vui lòng thoát khỏi hệ thống và đăng nhập lại');
				redirect(base_url().'admin');
			}else{
				// Sai thông báo lỗi ra ngoài
				$this->_data['error'] = 'Vui lòng kiểm tra lại thông tin.';
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

}

/* End of file profile.php */
/* Location: ./application/modules/admin/controllers/profile.php */