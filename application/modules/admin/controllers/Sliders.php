<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sliders
 */
class Sliders extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('unicode');
		$this->load->model(['msliders','msliders_groups']);
	}

	public function index()
	{
		$this->_data['title']   = 'Sliders';
		$this->_data['temp']    = 'sliders/index';
		$this->_data['sliders'] = $this->msliders->getSliders();		
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function create()
	{
		$this->_data['title']   = 'Thêm Slider mới';
		$this->_data['temp']    = 'sliders/create';
		$this->_data['sliders_groups'] = $this->msliders_groups->allSlidersGroups();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('params[title]', 'tiêu đề ảnh', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'numeric|required');
		if (empty($_FILES['image']['name'])){
			$this->form_validation->set_rules('image', 'ảnh slider', 'required');
		}
		$img = TRUE;
		if ($this->form_validation->run() == TRUE)
		{
			$params = $this->input->post('params');
			$slider = [
				'group_id'	  => $this->input->post('group_id'),
				'params'	  => json_encode($params,JSON_UNESCAPED_UNICODE),
				'ordering'	  => $this->input->post('ordering'),
				'public'	  => $this->input->post('public'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($params['title']));
				$config['upload_path'] 		= './uploads/sliders/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '*';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					$slider['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->msliders->insert($slider);
				$this->session->set_flashdata('success', 'Thao tác thêm thành công !');
				redirect(base_url().$this->_data['modules'].'/sliders');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders');
		}
		$slide = $this->msliders->getSlider($id);
		if (empty($slide)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders');
		}
		$this->_data['slide']   = $slide;
		$this->_data['title']   = 'Cập nhật sliders';
		$this->_data['temp']    = 'sliders/update';
		$this->_data['sliders_groups'] = $this->msliders_groups->allSlidersGroups();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('params[title]', 'tiêu đề ảnh', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'numeric|required');
		$img = TRUE;
		if ($this->form_validation->run() == TRUE)
		{
			$params = $this->input->post('params');
			$slider = [
				'group_id'	  => $this->input->post('group_id'),
				'params'	  => json_encode($params,JSON_UNESCAPED_UNICODE),
				'ordering'	  => $this->input->post('ordering'),
				'public'	  => $this->input->post('public'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id')
			];
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($params['title']));
				$config['upload_path'] 		= './uploads/sliders/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '*';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					$this->msliders->deleteImage('image',array('id'=>$id),'/uploads/sliders/');
					$slider['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->msliders->update($slider,array('id'=>$id));
				$this->session->set_flashdata('success', 'Thao tác cập nhật thành công !');
				redirect(base_url().$this->_data['modules'].'/sliders');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders');
		}
		$slide = $this->msliders->getSlider($id);
		if (empty($slide)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
			redirect(base_url().$this->_data['modules'].'/sliders');
		}
		$this->msliders->deleteImage('image',array('id'=>$id),'/uploads/sliders/');
		$this->msliders->delete(array('id'=>$id));
		$this->session->set_flashdata('success', 'Xóa slide thành công !');
		redirect(base_url().$this->_data['modules'].'/sliders');
	}

}
/* End of file sliders.php */
/* Location: ./application/modules/admin/controllers/sliders.php */