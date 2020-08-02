<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewcomposer extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('menu');
		$this->load->model('mcontent_block_types');
	}
	public function getFormData()
	{
		if ($this->input->is_ajax_request()) {
			$typeId = $this->input->get('type_id');
			$content_block = $this->mcontent_block_types->find($typeId);
			$actionParse = explode('BlocksComposer@', $content_block->action);
			$detail_form = strtolower(plural($actionParse[0]).'/'.$actionParse['1']);
			$this->load->view('viewcomposer/'.$detail_form,$this->_data);
		}
	}
	public function articleBlocksComposer()
	{
		$this->load->model('marticles');
		$this->_data['articles'] = $this->marticles->get_all_articles();
		$this->load->view('viewcomposer/article',$this->_data);
	}
	public function groupArticleBlocksComposer()
	{
		$this->load->model('mcategory');
		$this->_data['category'] = $this->mcategory->get_all_categories('article');
		$this->load->view('viewcomposer/article_categories',$this->_data);
	}
	public function slider_groups(){
		$this->load->model('msliders_groups');
		$this->_data['sliders_groups'] = $this->msliders_groups->allSlidersGroups();
		$this->load->view('viewcomposer/sliders_groups',$this->_data);
	}
}

/* End of file viewcomposer.php */
/* Location: ./application/modules/admin/controllers/viewcomposer.php */