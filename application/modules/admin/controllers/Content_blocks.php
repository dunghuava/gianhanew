<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_blocks extends AdminController 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['unicode','menu']);
		$this->load->model(['mcontent_blocks','mcontent_block_types']);
	}
	public function index()
	{
		$this->_data['title'] = 'Danh sách';
		$this->_data['temp']  = 'content_blocks/index';
		$this->_data['content_blocks'] = $this->mcontent_blocks->getContentBlocks();
		/*echo "<pre>";
		print_r($this->_data['content_blocks']);die;*/
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function create()
	{
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp']  = 'content_blocks/create';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên khối nội dung ', 'trim|required');
		$this->form_validation->set_rules('title_alias', ' bí danh ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$content_block = array(
				'title'			=> $this->input->post('title'),
				'title_alias'   => $this->input->post('title_alias'),
				'public'		=> $this->input->post('public'),
				'params'		=> json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'position'		=> $this->input->post('position'),
				'type_id'		=> $this->input->post('type_id'),
				'created_at'    => date('Y-m-d H:i:s'),
				'updated_at'    => date('Y-m-d H:i:s'),
				'created_by'    => $this->session->userdata('user_id'),
				'updated_by'    => $this->session->userdata('user_id')
			);
			$this->mcontent_blocks->insert($content_block);
			$this->session->set_flashdata('success', 'Thêm thành công khối nội dung');
			redirect(base_url().'admin/content_blocks');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function update($id)
	{
		if (!is_numeric($id) || !isset($id)) {
			$this->session->set_flashdata('error', 'Có lỗi xảy ra. Vui lòng thử lại');
			redirect(base_url().'admin/content_blocks');
		}
		$content_block = $this->mcontent_blocks->getContentBlockById($id);
		if (empty($content_block)) {
			$this->session->set_flashdata('error', 'Có lỗi xảy ra. Vui lòng thử lại');
			redirect(base_url().'admin/content_blocks');
		}
		$content_block_type = $this->mcontent_block_types->loadContentBlockTypes($content_block->type_id);
		if ($content_block_type) {
			$actionParse = explode('BlocksComposer@', $content_block_type->action);
			$this->_data['detail_form'] = strtolower(plural($actionParse[0]).'/'.$actionParse['1']);
		}
		$this->_data['content_block'] = $content_block;
		$this->_data['title'] = 'Khối nội dung';
		$this->_data['temp']  = 'content_blocks/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên khối nội dung ', 'trim|required');
		$this->form_validation->set_rules('title_alias', ' bí danh ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'title'			=> $this->input->post('title'),
				'title_alias'   => $this->input->post('title_alias'),
				'public'		=> $this->input->post('public'),
				'params'		=> json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'position'		=> $this->input->post('position'),
				'type_id'		=> $this->input->post('type_id'),
				'updated_at'    => date('Y-m-d H:i:s'),
				'updated_by'    => $this->session->userdata('user_id')
			);
			$this->mcontent_blocks->update($data,array('id'=>$id));
			$this->session->set_flashdata('success', 'Cập nhật thành công khối nội dung');
			redirect(base_url().'admin/content_blocks');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			redirect(base_url().'admin/content_blocks');
		}
		$content_block = $this->mcontent_blocks->getContentBlockById($id);
		if (empty($content_block)) {
			$this->session->set_flashdata('error', 'Có lỗi xảy ra. Vui lòng thử lại');
			redirect(base_url().'admin/content_blocks');
		}
		$this->session->set_flashdata('success', 'Bạn đã xóa thành công');
		$this->mcontent_blocks->delete(['id'=>$id]);
		redirect(base_url().'admin/content_blocks');
	}
}

/* End of file content_blocks.php */
/* Location: ./application/modules/admin/controllers/content_blocks.php */