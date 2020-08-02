<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_groups extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mmenu_groups');
	}
	public function index()
	{
		$this->_data['title'] = 'Danh sách';
		$this->_data['temp']  = 'menu_groups/index';
		$this->_data['menu_groups'] = $this->mmenu_groups->getMenuGroup();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Create group menu
	 */
	public function create()
	{
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp']  = 'menu_groups/create';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm !', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('title_alias', 'tên bí danh !', 'trim|required|min_length[5]|max_length[50]');
		if ($this->form_validation->run() == TRUE) {
			$menu_group = [
				'title'		  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'description' => $this->input->post('description'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
			$this->mmenu_groups->insert($menu_group);
			$this->session->set_flashdata('success', 'Thêm mới thành công !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Update group menu
	 */
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$menu_groups = $this->mmenu_groups->getGroup($id);
		if (empty($menu_groups)){
			$this->session->set_flashdata('error', 'Không tồn tại group !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$this->_data['menu_group'] = $menu_groups;
		$this->_data['title'] = 'Cập nhật';
		$this->_data['temp']  = 'menu_groups/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm !', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('title_alias', 'tên bí danh !', 'trim|required|min_length[5]|max_length[50]');
		if ($this->form_validation->run() == TRUE) {
			$menu_group = [
				'title'		  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'description' => $this->input->post('description'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
			$this->mmenu_groups->update($menu_group,['id'=>$id]);
			$this->session->set_flashdata('success', 'Cập nhật thành công !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Destroy
	 */
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$menu_groups = $this->mmenu_groups->getGroup($id);
		if (empty($menu_groups)){
			$this->session->set_flashdata('error', 'Không tồn tại group !');
			redirect(base_url().$this->_data['modules'].'/menu_groups');
		}
		$this->mmenu_groups->delete(['id'=>$id]);
		$this->session->set_flashdata('success', 'Xóa thành công !');
		redirect(base_url().$this->_data['modules'].'/menu_groups');
	}
}

/* End of file menu_groups.php */
/* Location: ./application/modules/admin/controllers/menu_groups.php */