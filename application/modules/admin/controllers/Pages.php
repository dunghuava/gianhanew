<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Pages
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com  | 0949.133.224
* @copyright 2015
*/
class Pages extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mpages');
		$this->load->helper('unicode');
	}
	/**
	* 
	*/
	public function index()
	{
		$this->_data['title'] = 'Dang sách';
		$this->_data['temp'] = 'pages/index';
		$this->_data['pages'] = $this->mpages->get_all_pages();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	*
	*/
	public function create()
	{
		$this->load->helper('template');
		$this->_data['title'] = 'Thêm mới trang web';
		$this->_data['temp'] = 'pages/create';
		// Validate Field

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		// Set Rule Validation
		$this->form_validation->set_rules('templates', '', 'callback_check_select');
		$this->form_validation->set_rules('title', 'tiêu đề', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('title_alias', 'bí danh', 'trim|required');
		$img = TRUE;
		// RUN VALIDATE
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'title'      => $this->input->post('title'),
				'title_alias'=> make_unicode($this->input->post('title_alias')),
				'params' 	 => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'public'	 => $this->input->post('public'),
				'content' 	 => $this->input->post('content'),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('user_id'),
				'updated_by' => $this->session->userdata('user_id')
			);
			$template = $this->input->post('templates');
			if (!in_template_page($template)){
				$this->_data['error'] = 'Lỗi Access. Xin vui lòng thử lại.';
			}else{
				$data['templates'] = $template;
			}
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] = convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path'] = './uploads/articles/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '1024';
				$config['max_width']  = '780';
				$config['max_height']  = '486';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					$this->load->library('image_lib', $config);
					$config['image_library'] = 'gd2';
					$config['source_image'] = './uploads/articles/'.$images['file_name'];
					$config['new_image'] = './uploads/articles/'.$images['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']  = THUMBNAIL_MAX_WIDTH;
					$config['height'] = THUMBNAIL_MAX_HEIGHT;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$data['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->mpages->insert($data);
				$this->session->set_flashdata('success','Thêm mới thành công');
				redirect(base_url().'admin/pages');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	*
	*/
	public function update($id)
	{
		if (!isset($id)) {
			redirect(base_url().'admin/pages');
		}else{
			$this->load->helper('template');
			$this->_data['title'] = 'Cập nhật trang web';
			$this->_data['temp'] = 'pages/update';
			// Validate Field
			$this->_data['page'] = $this->mpages->get_page_by_id($id);

			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			// Set Rule Validation
			$this->form_validation->set_rules('templates', '', 'callback_check_select');
			$this->form_validation->set_rules('title', 'tiêu đề vietnamese', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('title_alias', 'bí danh', 'trim|required|max_length[100]');
			$img = TRUE;
			// RUN VALIDATE
			if ($this->form_validation->run()==TRUE) 
			{
				$data = array(
					'title'      => $this->input->post('title'),
					'title_alias'=> make_unicode($this->input->post('title_alias')),
					'params' 	 => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
					'public'	 => $this->input->post('public'),
					'content' 	 => $this->input->post('content'),
					'updated_at' => date('Y-m-d H:i:s'),
					'updated_by' => $this->session->userdata('user_id')
				);
				$template = $this->input->post('templates');
				if (!in_template_page($template)){
					$this->_data['error'] = 'Lỗi Access. Xin vui lòng thử lại.';
				}else{
					$data['templates'] = $template;
				}
				if ($_FILES['image']['name'] != "")
				{
					$config['file_name'] = convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
					$config['upload_path'] = './uploads/articles/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']  = '1024';
					$config['max_width']  = '780';
					$config['max_height']  = '486';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('image')){
						$this->_data['error'] = $this->upload->display_errors();
						$img = FALSE;
					}
					else{
						$images = $this->upload->data();
						$this->load->library('image_lib', $config);
						$config['image_library'] = 'gd2';
						$config['source_image'] = './uploads/articles/'.$images['file_name'];
						$config['new_image'] = './uploads/articles/'.$images['file_name'];
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = THUMBNAIL_MAX_WIDTH;
						$config['height'] = THUMBNAIL_MAX_HEIGHT;
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$data['image'] = $images['file_name'];
						$img = TRUE;
					}
				}
				if ($img == TRUE)
				{
					$this->mpages->update($data,array('id'=>$id));
					$this->session->set_flashdata('success','Cập nhật thành công');
					redirect(base_url().'admin/pages');
				}
			}
			$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
		}
	}
	/**
	*
	*/
	public function destroy($id)
	{
		$this->mpages->delete(array('id'=>$id));
		if ($this->input->is_ajax_request())
		{
			echo 'finish';
		}
	}
	/**
	*
	*/
	public function check_select($element)
	{
		if($element == '0'){ 
			$this->form_validation->set_message('check_select', 'Chưa chọn template');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}