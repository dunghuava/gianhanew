<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends DefaultController
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('user_agent');
	}
	public function index()
	{
		$this->_data['meta_title']		= SITENAME;
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['home_block_1'] 	= $this->mcontent_blocks->getContentBlockByPosition('home-block-1');
		$this->_data['mostViews']    	= $this->marticles->mostViewArticle();
        $this->_data['bv_moinhat']      = $this->marticles->getLastNewByCateID();
        $this->_data['moinhattiep'] 	= $this->marticles->moinhattiep(); 
		$this->_data['main_realestates']= $this->realestate_model->getRealestateMain();
		// $this->_data['advertings']      = $this->madvertings->getAdvertingInPage(1);
		$this->_data['temp'] 			= 'main/index';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
}

/* End of file home.php */
/* Location: ./application/modules/default/controllers/home.php */