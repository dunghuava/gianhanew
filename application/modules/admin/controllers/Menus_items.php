<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_items extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mmenus_items','mmenus_type','mmenu_groups']);
		$this->load->helper(['unicode','menu']);
	}
	/**
	* 
	*/
	public function index()
	{
		$this->_data['title'] = 'Menus trên website';
		$this->_data['temp']  = 'menus/index';
		$this->_data['menus'] = $this->mmenus_items->get_all_menu();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* 
	*/
	public function create()
	{
		$this->_data['menu_groups'] = $this->mmenu_groups->getMenuGroup();
		$this->_data['menu_types']	= $this->mmenus_type->getMenusType();
		$this->_data['title'] = 'Thêm mới Menu';
		$this->_data['temp']  = 'menus/create';
		$this->_data['menus'] = $this->mmenus_items->get_all_menu();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		$this->form_validation->set_rules('title', 'tiêu đề', 'required');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'required|numeric');
		$img = TRUE;
		if ($this->form_validation->run() == TRUE)
		{
			$menu = array(
				'title' 	  => $this->input->post('title'),
				'parent_id'   => $this->input->post('parent_id'),
				'group_id'    => $this->input->post('group_id'),
				'type_id'     => $this->input->post('type_id'),
				'component_id'=> $this->input->post('component_id'),
				'public'	  => $this->input->post('public'),
				'ordering'	  => $this->input->post('ordering'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			$parent = $this->mmenus_items->get_path_and_path_alias($this->input->post('parent_id'));
			$parentPath = ($parent) ? $parent['path'] . '/' : null;
        	$parentPathAlias = ($parent) ? $parent['path_alias'] . '/' : null;
        	
        	$menu['path'] = $parentPath . $this->input->post('title');
        	$menu['path_alias'] = $parentPathAlias . make_unicode($this->input->post('title'));
			if ($img == TRUE)
			{
				$menuID = $this->mmenus_items->insert($menu);
				$this->session->set_flashdata('success','Thêm mới thành công');
				redirect(base_url().$this->_data['modules'].'/menus_items/');
			}
			
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* 
	*/
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại .');
			redirect(base_url().$this->_data['modules'].'/menus_items/');
		}
		$info_menu = $this->mmenus_items->get_menu_by_id($id);
		if (empty($info_menu)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại .');
			redirect(base_url().$this->_data['modules'].'/menus_items/');
		}
		$this->_data['menu_groups'] = $this->mmenu_groups->getMenuGroup();
		$this->_data['menu_types']	= $this->mmenus_type->getMenusType();
		// Begin
		$this->_data['title'] = 'Cập nhật Menu';
		$this->_data['temp']  = 'menus/update';
		$this->_data['menu']  = $info_menu;
		$this->_data['menus'] =  $this->mmenus_items->get_all_menu();;
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('title', 'tên menu', 'required');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'required|numeric');
		$img = TRUE;
		
		if ($info_menu->type == 'category')
		{
			$this->load->model('mcategory');
			$this->_data['component_id'] = $this->mcategory->get_all_categories($info_menu->component);
		}
		if ($info_menu->component == 'articles')
		{
			$this->load->model('marticles');
			$this->_data['component_id'] = $this->marticles->get_all_articles();
		}
		if ($this->form_validation->run() == TRUE)
		{
			$component 	   = $this->input->post('component');
			$component_id  = $this->input->post('component_id');
			$menu = array(
				'title' 	  => $this->input->post('title'),
				'parent_id'   => $this->input->post('parent_id'),
				'group_id'    => $this->input->post('group_id'),
				'type_id'     => $this->input->post('type_id'),
				'component_id'=> $this->input->post('component_id'),
				'public'	  => $this->input->post('public'),
				'ordering'	  => $this->input->post('ordering'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('user_id')
			);
			$parent = $this->mmenus_items->get_path_and_path_alias($this->input->post('parent_id'));
			$parentPath = ($parent) ? $parent['path'] . '/' : null;
        	$parentPathAlias = ($parent) ? $parent['path_alias'] . '/' : null;
        	
        	$menu['path'] = $parentPath . $this->input->post('title');
        	$menu['path_alias'] = $parentPathAlias . make_unicode($this->input->post('title'));
			if ($img == TRUE)
			{
				$this->mmenus_items->update($menu,array('id'=>$id));
				$this->session->set_flashdata('success','Cập nhật thành công');
				redirect(base_url().$this->_data['modules'].'/menus_items/');				
			}
			
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* 
	*/
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error','Đã có lỗi xảy ra, vui lòng thử lại sau');
			redirect(base_url().$this->_data['modules'].'/menus_items/');	
		}
		$info_menu = $this->mmenus_items->get_menu_by_id($id);
		if (empty($info_menu)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại .');
			redirect(base_url().$this->_data['modules'].'/menus_items/');
		}
		// Check
		$get_parent = $this->db->where('parent_id',$info_menu->id)->get('menus_items')->num_rows();
		if ($get_parent > 0){
			$this->session->set_flashdata('error', 'Không thể xóa danh mục. Cần xóa danh mục con thuộc chuyên mục này.');
			redirect(base_url().$this->_data['modules'].'/menus_items/');
		}else{
			$this->mmenus_items->delete(array('id'=>$id));
			$this->session->set_flashdata('success', 'Xóa thành công');
			redirect(base_url().$this->_data['modules'].'/menus_items/');
		}
	}

}

/* End of file menus_items.php */
/* Location: ./application/modules/admin/controllers/menus_items.php */