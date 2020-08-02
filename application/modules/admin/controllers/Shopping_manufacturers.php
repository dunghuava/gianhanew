<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_manufacturers extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['unicode']);
		$this->load->model(['mshopping_manufacturers']);
		session_start();
		$user = $this->session->userdata('username');
		$kcfinderSession = array(
			'disabled'  => false,
			'uploadURL' => base_url()."uploads/$user",
			'uploadDir' => ""
		);
		$_SESSION['KCFINDER'] = $kcfinderSession;
	}
	public function index()
	{
		$this->_data['title']         = 'Nhà sản xuất';
		$this->_data['temp']  		  = 'shopping_manufacturers/index';
		$this->_data['manufacturers'] = $this->mshopping_manufacturers->get_shopping_manufacturers();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function create()
	{
		$this->_data['title']         = 'Thêm nhà sản xuất';
		$this->_data['temp']  		  = 'shopping_manufacturers/create';
		$img = TRUE;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhà sản xuất', 'trim|required|max_length[110]|xss_clean');
		$this->form_validation->set_rules('title_alias', 'tên bí danh', 'trim|required|xss_clean');
		// Run
		if ($this->form_validation->run() == TRUE)
		{
			$manufacturer = array(
				'title'		  => $this->input->post('title'),
				'title_alias' => make_unicode($this->input->post('title_alias')),
				'params'      => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'public'	  => $this->input->post('public'),
				'summary'	  => $this->input->post('summary'),
				'featured'	  => $this->input->post('featured'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
				);
			// Upload logo
			if ($_FILES['image']['name'] != "")
			{
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path'] 		= './uploads/shopping_manufacturers/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= MAX_WIDTH_ARTICLE;
				$config['max_height']  		= MAX_HEIGHT_ARTICLE;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					/*	
					$this->load->library('image_lib', $config);
					$config['image_library']  = 'gd2';
					$config['source_image']   = './uploads/shopping_manufacturers/'.$images['file_name'];
					$config['new_image']      = './uploads/shopping_manufacturers/'.$images['file_name'];
					$config['create_thumb']   = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] 		  = '225';
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					*/
					$manufacturer['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->mshopping_manufacturers->insert($manufacturer);
				$this->session->set_flashdata('success', 'Thao tác thành công');
				redirect(base_url().'admin/shopping_manufacturers');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra. Vui lòng thử lại');
			redirect(base_url().'admin/shopping_manufacturers');
		}
		$this->_data['title']         = 'Cập nhật nhà sản xuất';
		$this->_data['temp']  		  = 'shopping_manufacturers/update';
		$img = TRUE;
		$this->_data['manufacturer']  = $this->mshopping_manufacturers->get_manufacturer_by_id($id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhà sản xuất', 'trim|required|max_length[110]|xss_clean');
		$this->form_validation->set_rules('title_alias', 'tên bí danh', 'trim|required|xss_clean');
		// Run
		if ($this->form_validation->run() == TRUE)
		{
			$manufacturer = array(
				'title'		  => $this->input->post('title'),
				'title_alias' => make_unicode($this->input->post('title_alias')),
				'public'	  => $this->input->post('public'),
				'summary'	  => $this->input->post('summary'),
				'featured'	  => $this->input->post('featured'),
				'params'      => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			// Upload logo
			if ($_FILES['image']['name'] != "")
			{
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path'] 		= './uploads/shopping_manufacturers/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= MAX_WIDTH_ARTICLE;
				$config['max_height']  		= MAX_HEIGHT_ARTICLE;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					/*	
					$this->load->library('image_lib', $config);
					$config['image_library']  = 'gd2';
					$config['source_image']   = './uploads/shopping_manufacturers/'.$images['file_name'];
					$config['new_image']      = './uploads/shopping_manufacturers/'.$images['file_name'];
					$config['create_thumb']   = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] 		  = '225';
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					*/
					$this->mshopping_manufacturers->deleteImage('image',array('id'=>$id),'/uploads/shopping_manufacturers/');
					$manufacturer['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->mshopping_manufacturers->update($manufacturer,array('id'=>$id));
				$this->session->set_flashdata('success', 'Thao tác thành công');
				redirect(base_url().'admin/shopping_manufacturers');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra. Vui lòng thử lại');
			redirect(base_url().'admin/shopping_manufacturers');
		}
		$shoppingProduct  = $this->db->select('id')->where('manufacturer_id',$id)->get('shopping_products')->num_rows();
		if ($shoppingProduct > 0) {
			$this->session->set_flashdata('error', 'Nhà sản xuất này không thể xóa do đã có sản phẩm sử dụng thông tin này');
			redirect(base_url().$this->_data['modules'].'/shopping_manufacturers');
		}
		$this->mshopping_manufacturers->deleteImage('image',array('id'=>$id),'/uploads/shopping_manufacturers/');
		$this->mshopping_manufacturers->delete(array('id'=>$id));
		$this->session->set_flashdata('success', 'Thao tác xóa thành công');
		redirect(base_url().$this->_data['modules'].'/shopping_manufacturers');
	}
	

}

/* End of file shopping_manufacturers.php */
/* Location: ./application/modules/admin/controllers/shopping_manufacturers.php */