<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realestates extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['unicode','menu']);
		$this->load->model('mrealestates');
	}
	public function index($approval)
	{
		$this->_data['title'] = 'Danh sách';
		$this->_data['temp']  = 'realestates/index';
		$this->load->library('pagination');
		$config['base_url']   = base_url().$this->_data['modules'].'/realestates/index/'.$approval;
		$config['total_rows'] = $this->mrealestates->countGetRealestates($approval);
		$config['per_page']   = 50;
		$config['uri_segment']= 5;
		$config['num_links']  = REALESTATE_PAGE_PER_SEGMENT;
		$config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'p';
		if(isset($_GET['p']) && !empty($_GET['p']))
			$page= (int) $_GET['p'];   
		else
            $page= 0;
		$this->_config_pagination();
		$this->pagination->initialize($config);
		// End Confign
		$this->_data['realestates'] = $this->mrealestates->getRealestates($config['per_page'],$page,$approval);
		$this->_data['link'] = $this->pagination->create_links();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function _config_pagination()
	{
		$config['full_tag_open']   = '<nav id="pagination" style="margin-top: 20px; float: left; width: 100%;"><ul class="pagination my-pagination pull-right">';
        $config['full_tag_close']  = '</ul></nav>';
        $config['first_link'] 	   = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] 	   = 'Trang sau';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
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
    public function reset()
    {
        $r = $this->db->select('id, start_date, end_date')->get('realestates')->result();
        foreach($r as $item)
        {
            $data = [
                'start_date'=> date('Y-m-d'),
                'end_date'  => date('Y-m-d',strtotime('+ 1 month')),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->where('id',$item->id)->update('realestates',$data);
        }
    }

    public function show($id){
    	if (!$realestate = $this->mrealestates->getRealestate($id)) {
    		$this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau.');
			redirect(base_url().$this->_data['modules'].'/realestates');
    	}
    	$this->_data['approval'] = $this->db->get('approval')->result();
    	$this->_data['title'] = 'Xem';
		$this->_data['temp']  = 'realestates/show';
		$this->_data['realestate']  = $realestate;
		if (isset($_POST['btnUpdate'])) {
			$approval = $this->input->post('approval');
			$this->mrealestates->update(['approval'=>$approval],['id'=>$id]);
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
    }
}
/* End of file Realestates.php */
/* Location: ./application/modules/admin/controllers/Realestates.php */