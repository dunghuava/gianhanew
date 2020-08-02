<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class External_links extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mexternal_links');
	}
	// Show
	public function index()
	{
		$this->_data['title'] = 'Link Nổi Bật';
		$this->_data['temp']  = 'external_links/index';
		$this->_data['external_links'] = $this->mexternal_links->getAll();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	// Create
	public function create()
	{
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp']  = 'external_links/create';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required|min_length[15]');
		if ($this->form_validation->run() == TRUE)
		{
			$ex = [
				'title' 	  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'ordering'    => $this->input->post('ordering'),
				'public'	  => $this->input->post('public'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			$this->mexternal_links->insert($ex);
			$this->session->set_flashdata('success', 'Thêm mới thành công !');
			redirect(base_url().$this->_data['modules'].'/external_links');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	//Update
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('alert', 'Đã có lỗi xảy ra !');
			redirect(base_url().$this->_data['modules'].'/external_links');
		}
		$getLink = $this->mexternal_links->getLink($id);
		if (empty($getLink))
		{
			$this->session->set_flashdata('alert', 'Đã có lỗi xảy ra !');
			redirect(base_url().$this->_data['modules'].'/external_links');
		}
		$this->_data['external_link'] = $getLink;
		$this->_data['title'] = 'Cập nhật';
		$this->_data['temp']  = 'external_links/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required|min_length[15]');
		if ($this->form_validation->run() == TRUE)
		{
			$ex = [
				'title' 	  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'ordering'    => $this->input->post('ordering'),
				'public'	  => $this->input->post('public'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			$this->mexternal_links->update($ex,['id'=>$id]);
			$this->session->set_flashdata('success', 'Xóa thành công !');
			redirect(base_url().$this->_data['modules'].'/external_links');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	// Destroy
	public function destroy($id)
	{
		$this->mexternal_links->delete(['id'=>$id]);
		$this->session->set_flashdata('success', 'Xóa thành công !');
		redirect(base_url().$this->_data['modules'].'/external_links');
	}
}

/* End of file External_links.php */
/* Location: ./application/modules/admin/controllers/External_links.php */