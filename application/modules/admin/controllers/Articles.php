<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Articles
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Articles extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('unicode','menu'));
		$this->load->model('marticles');
		@session_start();
	}
	public function index(){
		$this->_data['title'] = 'Bài viết';
		$this->_data['temp']  = 'articles/index';
		$this->_data['articles'] = $this->marticles->get_all_articles();
		
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Show the form for creating a new article
	*
	* @return Response
	*/
	public function create()
	{
		$this->_data['title'] = 'Thêm bài viết';
		$this->_data['temp']  = 'articles/create';
		// Validate Field
		$this->load->model('mcategory');
		$this->_data['category'] = $this->mcategory->get_all_categories('article');
		$this->load->library('form_validation');
		$rule_article = $this->marticles->rules;
		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'ảnh minh họa', 'required');
		}
		$this->form_validation->set_rules($rule_article['insert']);
		$img = TRUE;
		// RUN VALIDATE
		if ($this->form_validation->run()==TRUE) {
			$input_tags = $this->input->post('tags');

			$data = array(
				'title' 	  => $this->input->post('title'),
				'title_alias' => make_unicode($this->input->post('title_alias')),
				'public'	  => $this->input->post('public'),
                'is_home'	  => $this->input->post('is_home'),
                'is_comment'  => $this->input->post('is_comment'),
				'category_id' => $this->input->post('category_id'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			$data['params']   = json_encode(
				array(
					'meta_description' => '',
					'meta_keywords'    => str_replace(' ',',', trim(unicode2($this->input->post('title'))))
				)
			);
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title_alias')));
				$config['upload_path'] 		= './uploads/articles/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}
				else{
					$images = $this->upload->data();
					$data['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE){
				$articleID = $this->marticles->insert($data);
				if (!empty($input_tags)) {
					$config = [
						'taggable_id' => $articleID,
						'taggable_type' => $this->_data['controller']
					];
					$this->load->library('tagged',$config);
					$this->tagged->tag($input_tags);
				}
				// END TAG
				$this->session->set_flashdata('success','Thêm mới thành công');
				redirect(base_url().$this->_data['modules'].'/articles/update/'.$articleID);
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
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			redirect(base_url().$modules.'/articles');
		}
		// Tag
		// 
		$this->load->model('mtagging_tagged');
		$tagged = $this->mtagging_tagged->get_tag_by_article($id,$this->_data['controller']);
		if (!empty($tagged)) {
			$result = array();
			if (is_array($tagged)) {
				foreach ($tagged as $key => $tag) {
					$result[$key] = $tag['tag_name'];
				}
			}
			$this->_data['tagged'] = implode(',', $result);
		}
		$this->_data['title'] = 'Bài viết';
		$this->_data['temp'] = 'articles/update';
		$this->load->model('mcategory');
		$this->_data['category'] = $this->mcategory->get_all_categories('article');
        $article = $this->marticles->get_article($id);
        if (empty($article)) {
        	$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
        	redirect(base_url().$this->_data['modules'].'/articles/');
        }
        $this->_data['article'] = $article;
        $user = $this->session->userdata('username');
		$kcfinderSession = array(
			'disabled'  => false,
			'uploadURL' => base_url()."uploads/$user/$id",
			'uploadDir' => ""
		);
		$_SESSION['KCFINDER'] = $kcfinderSession;
		// Validate Field

		$this->load->library('form_validation');
		$rule_article = $this->marticles->rules;
		$this->form_validation->set_rules($rule_article['update']);
		$img = TRUE;
		// RUN VALIDATE
		if ($this->form_validation->run()==TRUE) 
		{
			$input_tags = $this->input->post('tags');
			$data = array(
				'title' 	  => $this->input->post('title'),
				'title_alias' => make_unicode($this->input->post('title_alias')),
				'params'      => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'public'	  => $this->input->post('public'),
                'is_home'	  => $this->input->post('is_home'),
                'is_comment'  => $this->input->post('is_comment'),
				'summary'	  => $this->input->post('summary'),
				'category_id' => $this->input->post('category_id'),
				'content'     => $this->input->post('content'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id'),
			);
			if ($_FILES['image']['name'] != "") {
				$config['file_name']     = convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title_alias')));
				$config['upload_path']   = './uploads/articles/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  	 = '1024';
				$config['max_width']  	 = '*';
				$config['max_height']  	 = '*';
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}else{
					$images = $this->upload->data();
					$this->marticles->deleteImage('image',array('id' => $id),'/uploads/articles/');
					$data['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			if ($img == TRUE){
				$this->marticles->update($data,array('id'=>$id));
				$config = [
					'taggable_id'   => $id,
					'taggable_type' => $this->_data['controller']
				];
				$this->load->library('tagged',$config);
				if (!empty($input_tags)) {
					$this->tagged->retag($input_tags);
				}else{
					$this->tagged->untag();
				}
				// END TAG
				$this->session->set_flashdata('success','Cập nhật thành công');
				redirect(base_url().$this->_data['modules'].'/articles/');
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
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
        	redirect(base_url().$this->_data['modules'].'/articles/');
		}
		$article = $this->marticles->get_article($id);
        if (empty($article)) {
        	$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại !');
        	redirect(base_url().$this->_data['modules'].'/articles/');
        }
		$this->marticles->deleteImage('image',array('id' => $id),'/uploads/articles/');
		$this->marticles->delete(array('id'=>$id));
		$this->session->set_flashdata('success','Xóa bài viết thành công');
		redirect(base_url().$this->_data['modules'].'/articles/');
	}
	public function ajax_destroy()
	{
		if ($this->input->is_ajax_request()) {
			$delete =  explode(',',$this->input->post('value'));
			$table  =  $this->input->post('type');
			if ($table == 'articles') {
				$successUpdate = $this->db->where_in('id',$delete)->delete($table);
				if ($successUpdate ==1) {
					echo json_encode(array('status'=>200));
				}else{
					echo json_encode(array('status'=>400));
				}
			}
		}
	}
}