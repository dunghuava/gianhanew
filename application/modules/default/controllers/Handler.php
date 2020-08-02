<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handler extends DefaultController 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('unicode');
	}
    public function checkModules()
    {
        if ($this->input->is_ajax_request())
        {
            $modules = $this->input->post('module');
            $productIds = $this->input->post('productIds');
            $productId = $productIds != "" ? $productIds : NULL;
            switch ($modules) {
                case 'getProductList':
                    $this->getProductList($productId);
                    break;
                default:
                    break;
            }
        }else{
            show_404();
        }
    }
    public function getProductList($productId)
    {
        if(!empty($productId)){
            $list = [];
            $this->load->model('default/realestate_model');
            $data = $this->realestate_model->getProductList($productId);
            if(!empty($data)){
                foreach($data as $k=> $item){
                    $list[$k]['title'] = $item->title;
                    $list[$k]['source_link'] = $item->slug_cate.'/'.$item->title_alias.'-'.toPublicId($item->id);
                    $list[$k]['id'] = $item->id;
                }
            }
            echo json_encode($list);
        }
    }
}

/* End of file Ajax.php */
/* Location: ./application/modules/default/controllers/Ajax.php */