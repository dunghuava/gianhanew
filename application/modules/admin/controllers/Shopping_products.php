<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_products extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('unicode','menu','location'));
		$this->load->model(['mshopping_products','mshopping_manufacturers','mshopping_size','mcategory']);
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
		$this->_data['title'] = 'Sản phẩm';
		$this->_data['temp']  = 'shopping_products/index';
		$this->_data['products'] = $this->mshopping_products->getProducts();		
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function create()
	{
		$img = TRUE;
		$this->_data['title'] = 'Thêm sản phẩm';
		$this->_data['temp']  = 'shopping_products/create';
		$this->load->library('form_validation');
		$this->_data['category'] = $this->mcategory->get_all_categories('product');
		$this->_data['manufacturers'] = $this->mshopping_manufacturers->get_shopping_manufacturers();
		$this->_data['sizes']         = $this->mshopping_size->getSizeSelect();
		// Validation
		$this->form_validation->set_rules('title', 'tiêu đề sản phẩm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title_alias', 'tiêu đề sản phẩm', 'trim|required|xss_clean');
		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'ảnh minh họa', 'trim|required|xss_clean');
		}
		if ($this->form_validation->run() == TRUE)
		{
			$size_id = $this->input->post('size_id');
			$product = array(
				'title' 	      => $this->input->post('title'),
				'title_alias'     => make_unicode($this->input->post('title_alias')),
				'params'          => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'detail'      	  => json_encode($this->input->post('detail'),JSON_UNESCAPED_UNICODE),
				'category_id' 	  => $this->input->post('category_id'),
				'manufacturer_id' => $this->input->post('manufacturer_id'),
				'made_in'		  => $this->input->post('made_in'),
				'price'			  => $this->input->post('price'),
				'old_price'		  => $this->input->post('old_price'),
				'discount_rate'   => $this->input->post('discount_rate'),
				'status'		  => $this->input->post('status'),
				'featured'		  => $this->input->post('featured'),
				'public'	      => $this->input->post('public'),
				'created_at'  	  => date('Y-m-d H:i:s'),
				'updated_at'      => date('Y-m-d H:i:s'),
				'created_by'      => $this->session->userdata('user_id'),
				'updated_by'      => $this->session->userdata('user_id'),

			);
			if (!empty($size_id) && is_array($size_id)) {
				$product['size_id'] = implode(',', $size_id);
			}
			// Upload hinh minh hoa
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path'] 		= './uploads/shopping_products/';
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
					$product['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE){
				$productID = $this->mshopping_products->insert($product);
				$this->session->set_flashdata('success','Thao tác thành công');
				redirect(base_url().'admin/shopping_products/gallery/'.$productID);
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function update($id)
	{
		$img = TRUE;
		if (!isset($id) || !is_numeric($id)){
			$this->session->set_flashdata('error', 'Đã xảy ra lỗi. Vui lòng thử lại');
			redirect(base_url().'admin/shopping_products');
		}
		$this->_data['title'] = 'Sản phẩm';
		$this->_data['temp']  = 'shopping_products/update';	
		$checkproduct = $this->mshopping_products->getProductById($id);
		if (empty($checkproduct)) {
			$this->session->set_flashdata('error', 'Không tồn tại sản phẩm này. Vui lòng thử lại');
			redirect(base_url().'admin/shopping_products');
		}
		$this->_data['product'] = $checkproduct;
		$this->load->library('form_validation');
		$this->_data['sizes']         = $this->mshopping_size->getSizeSelect();
		$this->_data['category'] 	  = $this->mcategory->get_all_categories('product');
		$this->_data['manufacturers'] = $this->mshopping_manufacturers->get_shopping_manufacturers();
		// Validation
		$this->form_validation->set_rules('title', 'tiêu đề sản phẩm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title_alias', 'tiêu đề sản phẩm', 'trim|required|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$size_id = $this->input->post('size_id');
			$product = array(
				'title' 	      => $this->input->post('title'),
				'title_alias'     => make_unicode($this->input->post('title_alias')),
				'params'          => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'detail'      	  => json_encode($this->input->post('detail'),JSON_UNESCAPED_UNICODE),
				'category_id' 	  => $this->input->post('category_id'),
				'manufacturer_id' => $this->input->post('manufacturer_id'),
				'made_in'		  => $this->input->post('made_in'),
				'price'			  => $this->input->post('price'),
				'old_price'		  => $this->input->post('old_price'),
				'discount_rate'   => $this->input->post('discount_rate'),
				'status'		  => $this->input->post('status'),
				'featured'		  => $this->input->post('featured'),
				'public'	      => $this->input->post('public'),
				'updated_at'      => date('Y-m-d H:i:s'),
				'updated_by'      => $this->session->userdata('user_id'),

			);
			if (!empty($size_id) && is_array($size_id)) {
				$product['size_id'] = implode(',', $size_id);
			}
			// Upload hinh minh hoa
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path'] 		= './uploads/shopping_products/';
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
					$config['source_image']   = './uploads/shopping_products/'.$images['file_name'];
					$config['new_image']      = './uploads/shopping_products/'.$images['file_name'];
					$config['create_thumb']   = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] 		  = '225';
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					*/
					$this->mshopping_products->deleteImage('image',array('id'=>$id),'/uploads/shopping_products/');
					$product['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE){
				$this->mshopping_products->update($product,array('id'=>$id));
				$this->session->set_flashdata('success','Thao tác cập nhật thành công');
				redirect(base_url().$this->_data['modules'].'/shopping_products');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* 
	* Xóa
	*/
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)){
			$this->session->set_flashdata('error', 'Đã xảy ra lỗi. Vui lòng thử lại');
			redirect(base_url().$this->_data['modules'].'/shopping_products');
		}
		$checkproduct = $this->mshopping_products->getProductById($id);
		if (empty($checkproduct)) {
			$this->session->set_flashdata('error', 'Không tồn tại sản phẩm này. Vui lòng thử lại');
			redirect(base_url().$this->_data['modules'].'/shopping_products');
		}
		$this->mshopping_products->deleteImage('image',array('id'=>$id),'/uploads/shopping_products/');
		$this->mshopping_products->delete(['id'=>$id]);
		$this->session->set_flashdata('success','Thao tác xóa thành công');
		redirect(base_url().$this->_data['modules'].'/shopping_products');
	}

	public function gallery($id)
	{
		// Check id
		if (!isset($id) || !is_numeric($id)){
			$this->session->set_flashdata('error', 'Đã xảy ra lỗi. Vui lòng thử lại');
			redirect(base_url().$this->_data['modules'].'/shopping_products');
		}
		$checkproduct = $this->mshopping_products->getProductById($id);
		if (empty($checkproduct)) {
			$this->session->set_flashdata('error', 'Không tồn tại sản phẩm này. Vui lòng thử lại');
			redirect(base_url().$this->_data['modules'].'/shopping_products');
		}
		//
		$this->load->model('mgallerys');
		$this->_data['title']    = 'Thêm / cập nhật';
		$this->_data['temp']     = 'shopping_products/gallery';	
		$this->_data['gallerys'] = $this->mgallerys->allGallerys($id);
		if(isset($_POST['doupload'])){
			$datacc = "";
			if($_FILES['userfile']['name'] != NULL){
				$userfile = $_FILES['userfile']['name'];
				if ($userfile[0] == ""){
					$this->_data['error'] = "Đã có lỗi xảy ra. Vui lòng chọn hình ảnh để upload";
				}else{
					$cpt = count($_FILES['userfile']['size']);
					foreach($_FILES as $key=>$value)
						for($i=0; $i<$cpt; $i++) 
						{
							$_FILES['userfile']['name']		= convert_file_to_date($value['name'][$i],make_unicode($checkproduct->title));
							$_FILES['userfile']['type']     = $value['type'][$i];
							$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$i];
							$_FILES['userfile']['error']    = $value['error'][$i];
							$_FILES['userfile']['size']     = $value['size'][$i];  
							$config['upload_path']   		= './uploads/shopping_products/';
							$config['allowed_types'] 		= 'gif|jpg|png';
							$config['max_size']      		= '*';
							$config['max_width']  			= '600';
							$config['max_height']  			= '600';
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload()) {
								$this->session->set_flashdata('errors', $this->upload->display_errors());
								redirect(base_url().'admin/shopping_products/gallery/'.$id);
							}else{
								$image = $this->upload->data();
								$datacc = array(
									'image'		 => $image['file_name'],
									'product_id' => $id,
								);
								$this->mgallerys->insert($datacc);
							}
						}
						$this->session->set_flashdata('success', 'Thêm / Cập nhật hình ảnh thành công');
						redirect(base_url().'admin/shopping_products/gallery/'.$id);
					}
				}else{
					$this->session->set_flashdata('success', 'Không có hình ảnh nào được cập nhật');
					redirect(base_url().'admin/shopping_products/gallery/'.$id);
				}
			}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
}

/* End of file products.php */
/* Location: ./application/modules/admin/controllers/products.php */