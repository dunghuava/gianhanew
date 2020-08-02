<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * AdminController
 * 
 * @author Pham Quoc Hieu <quochieuhcm@gmail.com  | 0949.133.224
 * @copyright 2015
 */
class AdminController extends MY_Controller
{
	public $_data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		$this->_data['modules'] 	= $this->router->fetch_module();
		$this->_data['class'] 		= $this->router->fetch_method();
		$this->_data['controller'] 	= $this->router->fetch_class();
		$mod = $this->router->fetch_class();
		$this->_data['root_site'] 	= base_url();
		$this->_data['level'] = $this->session->userdata('user_level');
		$this->_data['user_id'] = $this->session->userdata('user_id');
	}
}