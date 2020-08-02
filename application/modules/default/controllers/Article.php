<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends DefaultController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcategory');
	}
	public function tags($tag_slug,$page = 0)
	{
		if (!isset($tag_slug)) {
			redirect(base_url());
		}
        $this->load->model('mtagging_tagged');
        $tag = $this->mtagging_tagged->getInfoTag($tag_slug);
        if(empty($tag)){
            show404();
        }
        if($tag->taggable_type ==  'articles')
        {
            $data = $this->db->select('articles.id,articles.created_at,articles.title,articles.title_alias,articles.image, articles.updated_at, articles.summary,articles.params,categories.path,categories.title_alias as slug_cate')
                		 ->join('categories','categories.id = articles.category_id')
                		 ->join('tagging_tagged','tagging_tagged.taggable_id = articles.id')
                		 ->where(array('tagging_tagged.tag_slug'=>$tag_slug,'articles.public'=>1))
                		 ->get('articles')
                		 ->result();
            $this->_data['articles'] = $data;
            $this->_data['temp'] 	 = 'articles/tmp_tags';
        }
        if($tag->taggable_type ==  'projects')
        {
            $this->load->model('mprovinces');
            $this->_data['projects_cate'] = $this->mcategory->showCategoriesParent('project');
            $this->_data['provinces'] = $this->mprovinces->allProvinces();
            $data = $this->db->select('articles_projects.id,articles_projects.created_at,articles_projects.title,articles_projects.title_alias,articles_projects.image, articles_projects.updated_at, articles_projects.summary,articles_projects.params,categories.path,categories.title_alias as slug_cate')
                		 ->join('categories','categories.id = articles_projects.category_id')
                		 ->join('tagging_tagged','tagging_tagged.taggable_id = articles_projects.id')
                		 ->where(array('tagging_tagged.tag_slug'=>$tag_slug,'articles_projects.public'=>1))
                		 ->get('articles_projects')
                		 ->result();
            $this->_data['projects'] = $data;
            $this->_data['temp'] 	 = 'projects/tags';
        }
		$this->_data['meta_title']= isset(json_decode($tag->params)->meta_title) && !empty(json_decode($tag->params)->meta_title) ? json_decode($tag->params)->meta_title : $tag->tag_name ;
		$this->_data['meta_description'] = isset(json_decode($tag->params)->meta_description) && !empty(json_decode($tag->params)->meta_description) ? json_decode($tag->params)->meta_description : SITE_DESCRIPTION ;
		$this->_data['meta_keywords'] 	 = isset(json_decode($tag->params)->meta_keywords) && !empty(json_decode($tag->params)->meta_keywords) ? json_decode($tag->params)->meta_keywords : SITE_KEYWORDS ;
        $this->_data['meta_image']	 = LOGOSITE;
		
		
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
}

/* End of file article.php */
/* Location: ./application/modules/default/controllers/article.php */