<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends DefaultController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mpages');
		$this->load->helper(array('template'));
	}
	/**
	*
	*/
	public function index($alias,$page_num = 0)
	{
        $page = $this->mpages->get_detail($alias);
        if (!$page){
            show_404();
        }
        if (!in_template_page($page['templates'])){
        	show_404();
        }
	        // Set Attribute Meta
        $this->_data['meta_title'] = $page['title'];
        $this->_data['meta_description'] = json_decode($page['params'])->meta_description;
        $this->_data['meta_keywords'] = json_decode($page['params'])->meta_keywords;
        $this->_data['meta_image'] = LOGOSITE;
        $this->_data['temp'] = $page['templates'];
        $this->_data['main_realestates']= $this->realestate_model->getRealestateMain();
        $this->_data['post'] = $page;
        $this->_call_data_template($page['templates'],$page['id']);
        $this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	*
	*/
	public function _call_data_template($templates,$pageID)
	{
		switch ($templates) {
			case 'templates/tmp_contact':
				break;
			case 'templates/tmp_finance':
				$payment = [];
				$this->load->library('form_validation');
				if (isset($_POST['btnPayment'])) {
					$this->form_validation->set_rules('money', 'Số tiền', 'required');
					$this->form_validation->set_rules('time', 'Thời gian vay', 'required|numeric');
					$this->form_validation->set_rules('interest', 'Lãi xuất', 'required');
					if ($this->form_validation->run()) {
						$total_money  = (int)str_replace(',', '', $this->input->post('money'));
						$thang        = $this->input->post('time');
						$lai_xuat     = $this->input->post('interest');
						$goctra       = $total_money/$thang;
						$lai  = $total_money*($lai_xuat/12/100);
						for ($i=1; $i<=$thang;$i++) {
							if ($i == 1) {
								$conlai = $total_money- $goctra;
								$payment[$i]['t'] = $i;
								$payment[$i]['conlai'] = number_format($conlai);
								$payment[$i]['goctra'] = number_format($goctra);
								$payment[$i]['lai']    = number_format($lai);
								$payment[$i]['total']  = number_format($lai + $goctra);
							}else{
								$conlai = $conlai- $goctra;
								$lai    = ($conlai+$goctra)*$lai_xuat/12/100;
								$payment[$i]['t'] = $i;
								$payment[$i]['conlai'] = number_format($conlai);
								$payment[$i]['goctra'] = number_format($goctra);
								$payment[$i]['lai']    = number_format($lai);
								$payment[$i]['total']  = number_format($lai + $goctra);	
							}
						}
					}
					
				}
				$this->_data['payments'] = $payment;				
				break;
			default:
				# code...
				break;
		}
	}

}

/* End of file page.php */
/* Location: ./application/modules/default/controllers/page.php */