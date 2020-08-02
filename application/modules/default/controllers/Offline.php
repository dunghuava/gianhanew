<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offline extends DefaultController {
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$block = $this->_data['block_site'];
		if ($this->_data['block_site'] == 0) {
			redirect(base_url());
		}
		$data['offline_notify'] = OFFLINE_NOTIFY;
		$this->load->view('default/construction', $data);
	}

}

/* End of file offline.php */
/* Location: ./application/modules/default/controllers/offline.php */