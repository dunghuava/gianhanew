<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends DefaultController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['marticles','mcategory']);
	}
	public function index()
	{
		$search = NULL;
		$term = $this->input->post('search-term');

		$page = $this->uri->segment(3);
		if(!$page)
			$start = 0;
		else
			$start = $page;
		if(!empty($term)){
			$key_word  =$term;
			$this->session->set_userdata('key_word', $term);
		}
		else{
			$key_word = $this->session->userdata('key_word');
		}
		$this->_data['meta_title']		= empty($key_word) ? 'Tìm kiếm' : $key_word ;
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->load->library('pagination');
		$config['base_url'] 	   = base_url().'tim-kiem/trang/';
		$config['total_rows'] 	   = $this->marticles->count_get_data_search($key_word);
		$config['per_page'] 	   = 10;
		$config['uri_segment'] 	   = 3;
		$config['num_links'] 	   = ARTICLE_PAGE_PER_SEGMENT;
		$config['full_tag_open']   = "<nav id='pagination'><ul class='pagination item-text-right my-pagination'>";
		$config['full_tag_close']  = "</ul></nav>";
		$config['num_tag_open']    = '<li>';
		$config['num_tag_close']   = '</li>';
		$config['cur_tag_open']    = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close']   = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open']   = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open']   = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open']  = "<li>";
		$config['first_tagl_close']= "</li>";
		$config['last_tag_open']   = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		$this->_data['articles'] = $this->marticles->get_data_search($config['per_page'],$start,$key_word);
		$this->_data['link'] = $this->pagination->create_links();
		$this->_data['sidebars']  = $this->mcategory->getSidebar();
		$this->_data['temp'] = 'templates/tmp_search';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}

}

/* End of file search.php */
/* Location: ./application/modules/default/controllers/search.php */