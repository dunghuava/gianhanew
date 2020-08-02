<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PathsController extends DefaultController {

	public function __construct()
	{
		parent::__construct();
	}
	public function index($category_alias, $title_alias)
	{
		if (!isset($category_alias) || !is_string($category_alias)) {
			show404();
		}
		$category = $this->mcategory->checkCate($category_alias);
		if (empty($category)) {
			show404();
		}
		$this->_data['category'] = $category;
		switch ($category->component) {
			case 'article':
				$this->_viewArticle($category,$title_alias);
				break;
			case 'project':
				$this->_viewProject($category,$title_alias);
				break;
			case 'contact':
				$this->_viewContact($category,$title_alias);
				break;
			default:
				show404();
				break;
		}
	}
	/**
	 * View Detail Project
	 * 
	 * @param  [type] $category_id [description]
	 * @param  [type] $title_alias [description]
	 * @return [type]              [description]
	 */
	public function _viewProject($category, $title_alias)
	{
		$this->load->model(['mprovinces','mdistricts']);
		$project = $this->mprojects->show($category->id,$title_alias);
		if (empty($project)) {
			show_404();
		}
		$this->_data['project']    = $project;
		$this->_data['infoCate']   = $this->mcategory->getCateInfo($project->category_id);
		$this->_data['meta_title'] = $project->title;
		$this->_data['meta_description']= json_decode($project->params)->meta_description;
		$this->_data['meta_keywords'] = json_decode($project->params)->meta_keywords;
		$this->_data['meta_image'] = !empty($project->image) ? base_url().'uploads/projects/'.$project->image : LOGOSITE;
		$this->_data['title_hasParentCates']  = 'Danh mục dự án';
		$this->_data['hasParentCates']    = $this->mcategory->getHasParent($project->category_id);
		$this->_data['projectsFeatureds'] = $this->mprojects->featureds($project->category_id);
		// cùng chuyên mục
		$this->_data['same_categories'] = $this->mprojects->getArticleProjectSameCate($project->district_id,$project->id);
		if ($project->district_id != 0) {
			$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($project->province_id);
		}
        // tag
        $this->_data['tags'] = $this->db->select('taggable_id,tag_slug,tag_name')
                                		->where(array('taggable_id'=>$project->id,'taggable_type'=>'projects'))
                                		->get('tagging_tagged')
                                		->result();
		$this->_data['temp'] = 'projects/single-project';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	 * View Detail Article
	 * @param  [type] $category_id [description]
	 * @param  [type] $title_alias [description]
	 * @return [type]              [description]
	 */
	public function _viewArticle($category, $title_alias)
	{
		$this->load->model('marticles');
		$article = $this->marticles->getDetail($category->id,$title_alias);
		if (empty($article)) {
			redirect(base_urr().$category->title_alias);
		}
		$this->_data['article']         = $article;
        $this->_data['category']        = $category;
		$this->_data['meta_title']		= $article->title;
		$this->_data['meta_description']= json_decode($article->params)->meta_description;
		$this->_data['meta_keywords'] 	= json_decode($article->params)->meta_keywords;
		if (!empty($article->image)) {
			$this->_data['meta_image']	= base_url().'uploads/articles/'.$article->image;
		}else{
			$this->_data['meta_image']	= LOGOSITE;
		}
		$post_id = $article->id;
		if(isset($_COOKIE['read_articles']))
		{
			$read_articles = json_decode($_COOKIE['read_articles'], true);
			if(isset($read_articles[$post_id]) AND $read_articles[$post_id] == 1) {
			}else{
				$read_articles[$post_id] = 1;
				setcookie("read_articles",json_encode($read_articles),time()+60*1);
			}
		}else {
			$read_articles = Array();
			$read_articles[$post_id] = $article->hits + 1;
			setcookie("read_articles",json_encode($read_articles),time()+60*5);
			$this->marticles->update(array('hits'=>$read_articles[$post_id]),array('id'=>$post_id));
		}
		$this->_data['otherGetDetail']  = $this->marticles->otherGetDetail($category->id,$article->id);
		$this->_data['mostViews'] = $this->marticles->mostViewArticle($category->id);
		$this->_data['tags'] = $this->db->select('taggable_id,tag_slug,tag_name')
		                                ->where(array('taggable_id'=>$article->id,'taggable_type'=>'articles'))
		                                ->get('tagging_tagged')
		                                ->result();
		$this->_data['temp'] = 'articles/single-article';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	 * View Contact description]
	 * 
	 * @param  [type] $category    [description]
	 * @param  [type] $title_alias [description]
	 * @return [type]              [description]
	 */
	public function _viewContact($category, $title_alias){
		$this->load->model('mcontacts');
		if (!$contact = $this->mcontacts->showContact($category->id, $title_alias)) {
			show_404();
		}
		$this->_data['contact'] = $contact;
        $this->_data['category'] = $category;
		$this->_data['meta_title'] = $contact->title;
		$this->_data['meta_description']= '';
		$this->_data['meta_keywords'] 	= '';
		$this->_data['meta_image']	= LOGOSITE;
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'họ tên !', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'email !', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'số điện thoại !', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$data = [
				'HOTEN'   => $this->input->post('name'),
				'SDT' 	  => $this->input->post('phone'),
				'EMAIl'   => $this->input->post('email'),
				'CONTENT' => $this->input->post('contents')
			];
			$mail = new Mail();
			$template = 'contact.html';
			$mail->setMailBody($data,$template);
			$debug = $mail->sendMail($contact->title,$contact->email);
			if($debug){
				$this->session->set_flashdata('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ liên hệ bạn sớm.!');
			}else{
				$this->session->set_flashdata('error', 'Đã có lỗi xảy ra. Xin vui lòng thử lại sau');
			}	
		}
		$this->_data['temp'] = 'contacts/show';
		$this->load->view($this->_data['modules'].'/template', $this->_data);		
	}
}

/* End of file PathsController.php */
/* Location: ./application/modules/default/controllers/PathsController.php */