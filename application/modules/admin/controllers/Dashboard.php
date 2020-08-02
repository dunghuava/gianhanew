<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Dashboard Controller
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Dashboard extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('count_row');
		@session_start();
		$user = $this->session->userdata('username');
		$kcfinderSession = array(
			'disabled'  => false,
			'uploadURL' => base_url()."uploads/$user",
			'uploadDir' => ""
		);
		$_SESSION['KCFINDER'] = $kcfinderSession;
	}
	public function index()
	{
		$this->_data['title'] = 'Bảng điều khiển';
		$this->_data['temp'] = 'dashboard/index.php';  
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
}