<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertings extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['unicode','menu']);
		$this->load->model(['mgroup_advertings','madvertings']);
	}
	/**
	 * [index description]
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->_data['title'] = 'Danh sách';
		$this->_data['temp']  = 'advertings/index';
		$this->_data['advertings'] = $this->madvertings->getAll();
 		$this->load->view($this->_data['modules'].'/dashboard', $this->_data);
	}
	/**
	 * Create adverting
	 * 
	 * @return [type] [description]
	 */
	public function create()
	{
		$error = TRUE;
		$this->_data['title']  = 'Thêm mới';
		$this->_data['temp']   = 'advertings/create';
		$this->_data['groups'] = $this->mgroup_advertings->allgroups();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required');
		$this->form_validation->set_rules('group_id', '', 'callback_check_select[ Nhóm advertings !]');
		$this->form_validation->set_rules('adv_type', '', 'callback_check_select[ Kiểu advertings !]');	
		if ($this->form_validation->run() == TRUE)
		{
			$adv_type = $this->input->post('adv_type');
			
			$adv = [
				'adv_title'		=> $this->input->post('title'),
				'group_id'		=> $this->input->post('group_id'),
				'adv_link'		=> $this->input->post('adv_link'),
				'adv_position'	=> $this->input->post('adv_position'),
				'adv_type'		=> $this->input->post('adv_type'),
				'public'		=> $this->input->post('public'),
				'created_at'  	=> date('Y-m-d H:i:s'),
				'updated_at'  	=> date('Y-m-d H:i:s'),
				'created_by'  	=> $this->_data['user_id'],
				'updated_by'  	=> $this->_data['user_id']
			];
			if ($adv_type == 'upload') {
				if (empty($_POST['image']['name'])){
					$this->_data['error'] = 'Chọn hình hiển thị';
					$error = FALSE;
				}
			}
			if ($adv_type == 'code'){
				$adv_code = $this->input->post('adv_code');
                if (empty($adv_code)) {
					$this->_data['error'] = 'Nhập code hiển thị';
					$error = FALSE;
				}else{
					$adv['adv_code'] = $this->input->post('adv_code');
					$error     = TRUE;
				}
			}
			if ($_FILES['image']['name'] != ""){
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title')));
				$config['upload_path'] 		= './uploads/advertings/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$error = FALSE;
				}else{
					$images = $this->upload->data();
					$adv['adv_image'] = $images['file_name'];
					$error = TRUE;
				}
			}
			if ($error == TRUE){
				$this->madvertings->insert($adv);
				$this->session->set_flashdata('success', 'Thêm mới thành công !');
				redirect(base_url().$this->_data['modules'].'/advertings');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard', $this->_data);
	}


	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra');
			redirect(base_url().$this->_data['modules'].'/advertings');
		}
		$adverting = $this->madvertings->getAdverting($id);
		if (empty($adverting))
		{
			$this->session->set_flashdata('error', 'Không tồn tại adverting');
			redirect(base_url().$this->_data['modules'].'/advertings');
		}
		$error = TRUE;
		$this->_data['adverting'] = $adverting;
		$this->_data['title'] = 'Cập nhật';
		$this->_data['temp']  = 'advertings/update';
		
		$this->_data['groups'] = $this->mgroup_advertings->allgroups();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required');
		$this->form_validation->set_rules('group_id', '', 'callback_check_select[ Nhóm advertings !]');
		$this->form_validation->set_rules('adv_type', '', 'callback_check_select[ Kiểu advertings !]');	
		if ($this->form_validation->run() == TRUE){
			$adv_type = $this->input->post('adv_type');
			$adv = [
				'adv_title'		=> $this->input->post('title'),
				'group_id'		=> $this->input->post('group_id'),
				'adv_link'		=> $this->input->post('adv_link'),
				'adv_position'	=> $this->input->post('adv_position'),
				'adv_type'		=> $this->input->post('adv_type'),
				'public'		=> $this->input->post('public'),
				'created_at'  	=> date('Y-m-d H:i:s'),
				'updated_at'  	=> date('Y-m-d H:i:s'),
				'created_by'  	=> $this->_data['user_id'],
				'updated_by'  	=> $this->_data['user_id']
			];
			if ($adv_type == 'code'){
				$adv_code = $this->input->post('adv_code');
                if (empty($adv_code)) {
					$this->_data['error'] = 'Nhập code hiển thị';
					$error = FALSE;
				}else{
					$adv['adv_code'] = $this->input->post('adv_code');
					$error = TRUE;
				}
			}
			if ($_FILES['image']['name'] != ""){
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title')));
				$config['upload_path'] 		= './uploads/advertings/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$error = FALSE;
				}else{
					$images = $this->upload->data();
					$this->madvertings->deleteImage('adv_image',array('adv_id' => $id),'/uploads/advertings/');
					$adv['adv_image'] = $images['file_name'];
					$error = TRUE;
				}
			}
			if ($error == TRUE){
				$this->madvertings->update($adv,['adv_id'=>$id]);
				$this->session->set_flashdata('success', 'Cập nhật thành công !');
				redirect(base_url().$this->_data['modules'].'/advertings');
			}
		}

		$this->load->view($this->_data['modules'].'/dashboard', $this->_data);
	}

	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra');
			redirect(base_url().$this->_data['modules'].'/advertings');
		}
        $adverting = $this->madvertings->getAdverting($id);
		if (empty($adverting)){
			$this->session->set_flashdata('error', 'Không tồn tại adverting');
			redirect(base_url().$this->_data['modules'].'/advertings');
		}
		$this->madvertings->deleteImage('adv_image',array('adv_id' => $id),'/uploads/advertings/');
		$this->madvertings->delete(['adv_id' => $id]);
		$this->session->set_flashdata('success', 'Xóa thành công');
		redirect(base_url().$this->_data['modules'].'/advertings');
	}
	public function check_select($element,$label=''){
		if($element == '-1'){
			$this->form_validation->set_message('check_select', 'Chọn '.$label);
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

/* End of file Advertings.php */
/* Location: ./application/modules/admin/controllers/Advertings.php */