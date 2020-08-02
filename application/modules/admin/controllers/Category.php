<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Category
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Category extends AdminController{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('unicode','menu','template'));
		$this->load->model(['mcategory','mgroup_advertings']);
		$this->load->library('mystring');
	}
	public function index($component)
	{
		if (!isset($component)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');
		}
		$this->_data['category'] = $this->mystring->showMenu(0,$this->mcategory->get_all_categories($component));
		$this->_data['title']    = 'Danh sách';
		$this->_data['temp']     = 'category/'.$component.'/index';
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Show the form for creating a new article
	*
	* @return Response
	*/
	public function create($component)
	{
		if (!isset($component)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');	
		}
		if (!in_components($component)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');	
		}
		$this->_data['title']  = 'Thêm mới nhóm';
		$this->_data['temp']   = 'category/'.$component.'/create';
		$this->_data['groups'] = $this->mgroup_advertings->allgroups();
		
		$this->_data['category'] = $this->mcategory->get_all_categories($component);
		$img = TRUE;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title_alias', 'bí danh', 'trim|required|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			$categorie = array(
				'title'		 => $this->input->post('title'),
				'component'  => $component,
				'title_alias'=> make_unicode($this->input->post('title_alias')),
				'parent_id'  => $this->input->post('parent_id'),
				'type_id'    => $this->input->post('type_id'),
				'group_id'   => $this->input->post('group_id'),
				'summary'    => $this->input->post('summary'),
				'params'     => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('user_id'),
				'updated_by' => $this->session->userdata('user_id')
			);
			if ($this->uri->segment(4) == 'product') {
				$categorie['type_id'] =$this->input->post('type_id');
			}
			$parent = $this->mcategory->get_path_and_path_alias($this->input->post('parent_id'));
			$parentPath = ($parent) ? $parent['path'] . '/' : null;
        	$parentPathAlias = ($parent) ? $parent['path_alias'] . '/' : null;
        	$categorie['path'] = $parentPath . $this->input->post('title');
        	$categorie['path_alias'] = $parentPathAlias . make_unicode($this->input->post('title_alias'));
        	// Upload Image Thumbnail
        	if (isset($_FILES['image'])) {
	        	if ($_FILES['image']['name'] != "") {
					$config['file_name']     = convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
					$config['upload_path']   = './uploads/category/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']      = '*';
					$config['max_width']     = '*';
					$config['max_height']    = '*';
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('image')){
						$this->_data['error'] = $this->upload->display_errors();
						$img = FALSE;
					}
					else{
						$images = $this->upload->data();
						$this->load->library('image_lib', $config);
						$config['image_library'] = 'gd2';
						$config['source_image'] = './uploads/category/'.$images['file_name'];
						$config['new_image']    = './uploads/category/'.$images['file_name'];
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 350;
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$categorie['image'] = $images['file_name'];
						$img = TRUE;
					}
				}
        	}
			if ($img == TRUE)
			{
				$this->mcategory->insert($categorie);
				$this->session->set_flashdata('success', 'Thêm mới thành công');
				redirect(base_url().$this->_data['modules'].'/category/index/'.$component);	
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Update the specified article in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update($id,$component){

		if (!is_numeric($id) || !isset($id) || !isset($component)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');	
		}
		if (!in_components($component)) {
			redirect(base_url().'admin');	
		}
		$this->_data['title'] = 'Cập nhật nhóm';
		$this->_data['temp']  = 'category/'.$component.'/update';
		$this->load->library('form_validation');
		$categories = $this->mcategory->getCategoriesById($id,$component);
		if (empty($categories)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');
		}
		$this->_data['groups'] = $this->mgroup_advertings->allgroups();
		$this->_data['categories'] = $categories;
		$this->_data['category']   = $this->mcategory->get_all_categories($component,$id);
		$img = TRUE;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên nhóm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title_alias', 'bí danh', 'trim|required|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$categorie = array(
				'title'		 => $this->input->post('title'),
				'title_alias'=> make_unicode($this->input->post('title_alias')),
				'component'  => $component,
				'public'     => $this->input->post('public'),
				'summary'    => $this->input->post('summary'),
				'params'     => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'group_id'   => $this->input->post('group_id'),
 				'parent_id'  => $this->input->post('parent_id'),
				'type_id'    => $this->input->post('type_id'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('userid')
			);
			//
			$parent = $this->mcategory->get_path_and_path_alias($this->input->post('parent_id'));
			$parentPath = ($parent) ? $parent['path'] . '/' : null;
        	$parentPathAlias = ($parent) ? $parent['path_alias'] . '/' : null;
        	
        	$categorie['path'] = $parentPath . $this->input->post('title');
        	$categorie['path_alias'] = $parentPathAlias . make_unicode($this->input->post('title_alias'));
			//
			if ($_FILES['image']['name'] != "") {
				$config['file_name']     = convert_file_to_date($_FILES['image']['name'],$this->input->post('title_alias'));
				$config['upload_path']   = './uploads/category/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '*';
				$config['max_width']     = '*';
				$config['max_height']    = '*';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}else{
					$images = $this->upload->data();
					$this->load->library('image_lib', $config);
					$config['image_library'] = 'gd2';
					$config['source_image'] = './uploads/category/'.$images['file_name'];
					$config['new_image'] = './uploads/category/'.$images['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 350;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$categorie['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE)
			{
				$this->mcategory->update($categorie,array('id'=>$id));
				$this->session->set_flashdata('success','Cập nhật chuyên mục'.$this->input->post('title').' thành công');
				redirect(base_url().$this->_data['modules'].'/category/index/'.$component);	
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Remove the specified article from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id,$component)
	{
		if (!isset($id) || !isset($component)) {
			redirect(base_url().$this->_data['modules'].'/category/index/article');
		}
		$hasData = $this->db->where(array('id'=>$id,'component'=>$component))->get('categories')->num_rows();
		if ($hasData == 0) {
			$this->session->set_flashdata('success','Không tồn tại chuyên mục bạn cần xóa');
			redirect(base_url().$this->_data['modules'].'/category/index/'.$component);
		}
		// Kiem tra truoc khi xoa
		$check_parent = $this->db->where(array('parent_id'=>$id,'component'=>$component))->get('categories')->num_rows();
		if ($check_parent > 0)
		{
			$this->session->set_flashdata('error','Bạn không thể xóa chuyên mục này. Vui lòng kiểm tra chuyên mục này có còn chuyên mục con hay không ?');
			redirect(base_url().$this->_data['modules'].'/category/index/'.$component);
		}else{
			$hasDataArticle = $this->db->where(array('category_id'=>$id))->get('articles')->num_rows();
			if ($hasDataArticle > 0){
				$this->session->set_flashdata('error','Còn bài viết trong chuyên mục này bạn không thể xóa.');
				redirect(base_url().$this->_data['modules'].'/category/index/'.$component);
			}else{
				$this->mcategory->delete(array('id'=>$id));
				$this->session->set_flashdata('success','Xóa thành công !');
				redirect(base_url().$this->_data['modules'].'/category/index/'.$component);
			}
		}
	}
}