<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DefaultController
 * 
 * @author Pham Quoc Hieu <quochieuhcm@gmail.com  | 0949.133.224
 * @copyright 2015
 */
class DefaultController extends MY_Controller
{
    public $_data;
	public function __construct()
	{
		parent::__construct();
        $this->load->helper(['menu','unicode','count_row']);
        $this->_data['modules'] = $this->router->fetch_module();
        $this->_data['class']   = $this->router->fetch_method();
        $controller             = $this->router->fetch_class();
        $this->_data['controller'] = $controller;
        $this->_data['domain'] = base_url();
		$setting = $this->msetting->get_setting_site();
        $sets = ($setting['value'] != "") ? json_decode($setting['value']) : json_decode($setting['default']);
        if ($sets->offline != 0 && $controller != 'offline') {
            redirect(base_url().'under-construction.html');
        }
        $this->_data['block_site'] = $sets->offline;
        $this->_data['setting']    = $sets;
        $this->get_navigation();
        $this->_data['taged']= $this->db->select('name,slug')->order_by('id','RANDOM')->limit(15)->get('tagging_tags')->result();
    }
    public function get_navigation()
    {
        $this->_data['navigation']  = $this->mmenus_items->get_menus(1);
    }
    public function checkLogin()
    {
        if(!$this->session->userdata("user_level"))
        {
            redirect(base_url()."dang-nhap.htm");
        }else{
            $user_level = $this->session->userdata("user_level");
            $this->load->helper('auth');
            if (!in_list_role($user_level)) {
                session_destroy();
                redirect(base_url()."dang-nhap.htm");
            }
        }
    }
    public function isLogined()
    {
        if ($this->session->userdata("user_level")) {
            redirect(base_url().'thanh-vien/quan-ly-tin-rao.htm');
        }
    }
}