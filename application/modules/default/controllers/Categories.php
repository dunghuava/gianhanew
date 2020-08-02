<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends DefaultController {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
		$this->load->model(['mcategory']);
	}
	/**
	 * Get All Artcle
	 */
	public function category($slug)
	{
		if (!isset($slug) || !is_string($slug)) {
			show_404();
		}
		$checkCate = $this->mcategory->checkCate($slug);
		if (empty($checkCate)) {
			show_404();
		}
		// Check In Helper Template
		if (!in_components($checkCate->component)) {
			show_404();
		}
		$this->_data['category']   = $checkCate;
		// SEO
		$this->_data['meta_title'] = str_replace(',',' ', json_decode($checkCate->params)->meta_title);
		$this->_data['meta_description'] = json_decode($checkCate->params)->meta_description;
		$this->_data['meta_keywords'] = json_decode($checkCate->params)->meta_keywords;
		$this->_data['meta_image'] = !empty($checkCate->image) ? base_url().'uploads/category/'.$checkCate->image : LOGOSITE;
		$condition = '';
		$chidlren = $this->mcategory->getCategoriesByParentId($checkCate->id);
		if (!empty($chidlren)){
			$condition = $chidlren;
		}else{
			$condition = $checkCate->id;
			$this->_data['hasParentCates'] = $this->mcategory->hasParent($checkCate->id,$checkCate->parent_id);
		}
		$page= isset($_GET['p']) && !empty($_GET['p']) ? (int) $_GET['p'] : 0;
		switch ($checkCate->component) {
			case 'article':
				$this->load->library('pagination');
				$config['base_url'] 	   = base_url().$slug;
				$config['total_rows'] 	   = $this->marticles->count_getListAticles($condition);
				$config['per_page'] 	   = ARTICLE_RECORD_PER_PAGE;
				$config['uri_segment'] 	   = 3;
				$config['num_links'] 	   = ARTICLE_PAGE_PER_SEGMENT;
				$this->_config_pagination();
				$this->pagination->initialize($config);
				$this->_data['articles'] = $this->marticles->getListAticles($condition,$config['per_page'],$page);
				$this->_data['link']  = $this->pagination->create_links();
				$this->_data['title_hasParentCates']  = 'Xem thêm danh mục';
				$this->_data['temp'] = 'articles/archive-article';
				break;
			case 'project':
				$this->load->model('mprovinces');
				$this->_data['provinces'] = $this->mprovinces->allProvinces();
				$this->_data['projects_cate'] = $this->mcategory->showCategoriesParent('project');
				$this->load->library('pagination');
				$config['base_url'] 	 = base_url().$slug;
				$config['total_rows'] 	 = $this->mprojects->count_getProjectsByCateID($condition);
				$config['per_page'] 	 = PROJECT_RECORD_PER_PAGE;
				$config['uri_segment'] 	 = 3;
				$config['num_links'] 	 = PROJECT_PAGE_PER_SEGMENT;
				$this->_config_pagination();
				$this->pagination->initialize($config);
				$this->_data['projects'] = $this->mprojects->getProjectsByCateID($condition,$config['per_page'],$page);
				$this->_data['link']  = $this->pagination->create_links();
				// du an noi bat
				$this->_data['title_hasParentCates']  = 'Danh mục dự án';
				$this->_data['projectsFeatureds'] = $this->mprojects->featureds($condition);
				$this->_data['temp'] = 'projects/archive-project';
				break;
			case 'realestate':
				$where = '';
				$direct= isset($_GET['direct']) ? (int)$_GET['direct'] : '0';
				$price = isset($_GET['price']) ? (int)$_GET['price'] : '0';
				$area  = isset($_GET['area']) ? (int)$_GET['area'] : '0';
				$unit  = isset($_GET['unit']) ? (int)$_GET['unit'] : '0';
				$URI = "?direct=$direct&price=$price&area=$area&unit=$unit";
				if ($direct != 0)
					$where .= 'AND home_direction='.$direct;
				if ($price != 0)
					$where .= ' AND price ='.$price;
				if ($area != 0)
					$where.= ' AND area ='.$area;
				if ($unit != 0)
					$where .= ' AND price_type ='.$unit;
				$this->_data['title_hasParentCates'] = 'Xem thêm danh mục';
				$this->load->model(['default/realestate_model','mprovinces']);
				$this->_data['provinces'] = $this->mprovinces->allProvinces();
				$this->load->library('pagination');
				$config['base_url'] 	   = base_url().$slug.$URI;
				$config['total_rows'] 	   = $this->realestate_model->countRealestateCategoryId($condition,$where);
				$config['per_page'] 	   = REALESTATE_RECORD_PER_PAGE;
				$config['uri_segment'] 	   = 3;
				$config['num_links'] 	   = REALESTATE_PAGE_PER_SEGMENT;
				$this->_config_pagination();
				$this->pagination->initialize($config);
				$this->_data['realestates'] = $this->realestate_model->getRealestateCategoryId($condition,$config['per_page'],$page,$where);
				$this->_data['link'] = $this->pagination->create_links();
				$this->_data['temp'] = 'realestates/archive-realestates';
				break;
			default:
				show_404();
				break;
		}
		$this->_data['advertings'] = $this->madvertings->getAdvertingInPage($checkCate->group_id);
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	// Config Pagination
	public function _config_pagination()
	{
		$config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'p';
		$config['full_tag_open'] = '<nav id="pagination"><ul class="pagination my-pagination pull-right">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = false;
        $config['last_link']  = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Trang sau';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Trang kế tiếp';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $config;
	}

}
/* End of file article.php */
/* Location: ./application/modules/default/controllers/article.php */
?>