<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Authentication
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com  | 0949.133.224
* @copyright 2015
*/
class Authentication extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->isLogined();
		$this->load->library('form_validation');
		$this->_data['error']="";
		$this->form_validation->set_rules('username', 'tài khoản đăng nhập','trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password', 'mật khẩu','trim|required|min_length[3]|max_length[50]');
        if ($this->form_validation->run() == TRUE) {
            $this->load->model('musers');
            $username = $this->input->post('username');
            $password = md5(sha1($this->input->post('password')));
            $data = $this->musers->check_login($username,$password);
            if($data == false){
                $this->_data['error'] = 'Thông tin đăng nhập không chính xác';
            }else{
                $sess = array(
                    "username"      => $data['username'],
                    "display_name"  => $data['display_name'],
                    "user_id"       => $data['user_id'],
                    "user_level"    => $data['level'],
                    );
                $this->session->set_userdata($sess);
                $this->load->model('musertrackers');
                $this->musertrackers->insert(
                    array(
                        'user_id'     => $this->session->userdata('user_id'),
                        'browser'     => $_SERVER['HTTP_USER_AGENT'],
                        'ip_address'  => $_SERVER['REMOTE_ADDR'],
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s')
                        )
                    );
                if ($data['level'] == 4)
                {
                    redirect(base_url()."admin");
                }else{
                    $this->session->set_flashdata('success', 'Đăng nhập hệ thống thành công !');
                    redirect(base_url()."admin");
                }
            } 
        }
        $this->load->view($this->_data['modules'].'/login',$this->_data);
    }
	// Logout
    public function logout()
    {
        @session_start();
        session_destroy();
        redirect(base_url()."login.html");
    }
	// Check Logined
    public function isLogined()
    {
        $level = $this->session->userdata('permissions');
        if (isset($level) && $level != "") {
            redirect(base_url()."admin");
        }
    }
}