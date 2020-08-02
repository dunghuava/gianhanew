<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sliders
 */
class Sliders_groups extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('msliders_groups');
	}
	
	public function index()
	{
		$this->_data['title']   = 'Slider Groups';
		$this->_data['temp']    = 'sliders_groups/index';
		$this->_data['sliders_groups'] = $this->msliders_groups->allSlidersGroups();		
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function create()
	{
		$this->_data['title']   = 'Thêm Slider Groups';
		$this->_data['temp']    = 'sliders_groups/create';
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required|max_length[121]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$groups = [
				'title'	      => $this->input->post('title'),
				'summary'	  => $this->input->post('summary'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			$this->msliders_groups->insert($groups);
			$this->session->set_flashdata('success', 'Thao tác thêm thành công !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');

		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');
		}
		$sliders_group = $this->msliders_groups->group($id);
		if (empty($sliders_group)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');
		}
		$this->_data['group'] = $sliders_group;
		$this->_data['title']   = 'Cập nhật';
		$this->_data['temp']    = 'sliders_groups/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required|max_length[121]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$groups = [
				'title'	      => $this->input->post('title'),
				'summary'	  => $this->input->post('summary'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			$this->msliders_groups->update($groups,array('id'=>$id));
			$this->session->set_flashdata('success', 'Thao tác cập nhật thành công !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');

		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');
		}
		$sliders_group = $this->msliders_groups->group($id);
		if (empty($sliders_group)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');
		}
		$has_anh = $this->db->where('group_id', $id)->get('sliders')->num_rows();
		if (!empty($has_anh)) {
			$this->session->set_flashdata('error', 'Vẫn còn sider ảnh trong nhóm này. Bạn không thể xóa nhóm này!');
			redirect(base_url().$this->_data['modules'].'/sliders_groups');
		}
		$this->msliders_groups->delete(array('id'=>$id));
		$this->session->set_flashdata('success', 'Xóa thành công !');
		redirect(base_url().$this->_data['modules'].'/sliders_groups');
	}

}
/* End of file sliders.php */
/* Location: ./application/modules/admin/controllers/sliders.php */