<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_advertings extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mgroup_advertings');
	}
	/**
	 * 
	 * Index : Show all group adverting
	 *
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->_data['title']  = 'Danh sách';
		$this->_data['temp']   = 'group_advertings/index';
		$this->_data['groups'] =  $this->mgroup_advertings->allgroups();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * 
	 * create a new group
	 * 	 * 
	 * @return [type] [description]
	 */
	public function create()
	{
		$this->_data['title'] = 'Cập nhật';
		$this->_data['temp']  = 'group_advertings/create';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required|max_length[100]');
		if ($this->form_validation->run() == TRUE)
		{
			$group_adv = [
				'title' 	  => $this->input->post('title'),
				'summary'     => $this->input->post('summary'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
			$this->mgroup_advertings->insert($group_adv);
			$this->session->set_flashdata('success', 'Thêm mới thành công !');
			redirect($this->_data['modules'].'/group_advertings');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Update
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra !');
			redirect($this->_data['modules'].'/group_advertings');
		}
		$group = $this->mgroup_advertings->group($id);
		if (empty($group)) {
			$this->session->set_flashdata('error', 'Không tồn tại nhóm này !');
			redirect($this->_data['modules'].'/group_advertings');
		}
		$this->_data['group'] = $group;
		$this->_data['title'] = 'Cập nhật';
		$this->_data['temp']  = 'group_advertings/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required');
		if ($this->form_validation->run() == TRUE){
			$group_adv = [
				'title' 	  => $this->input->post('title'),
				'summary'     => $this->input->post('summary'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
			$this->mgroup_advertings->update($group_adv,['id'=>$id]);
			$this->session->set_flashdata('success', 'Cập nhật thành công !');
			redirect($this->_data['modules'].'/group_advertings');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Destroy
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra');
			redirect($this->_data['modules'].'/group_advertings');
		}
		$group = $this->mgroup_advertings->group($id);
		if ($group->is_home == 1) {
			$this->session->set_flashdata('error', 'Không thể xóa nhóm mặc định');
			redirect($this->_data['modules'].'/group_advertings');
		}else{
			// check adverting có trong nhóm
			$this->load->model('madvertings');
			$check = $this->madvertings->checkGroup($id);
			if ($check) {
				$this->session->set_flashdata('error', 'Không thể xóa, vui lòng xóa advertings thuộc nhóm này trước');
				redirect($this->_data['modules'].'/group_advertings');
			}else{
				$this->mgroup_advertings->delete(['id'=>$id]);
				$this->session->set_flashdata('success', 'Xóa thành công !');
				redirect($this->_data['modules'].'/group_advertings');
			}
		}
	}
}

/* End of file Group_advertings.php */
/* Location: ./application/modules/admin/controllers/Group_advertings.php */