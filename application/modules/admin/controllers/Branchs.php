<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branchs extends AdminController {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('unicode');
		$this->load->model('mbranchs');
		session_start();
		$user = $this->session->userdata('username');
		$kcfinderSession = array(
			'disabled'  => false,
			'uploadURL' => base_url()."uploads/$user",
			'uploadDir' => ""
		);
		$_SESSION['KCFINDER'] = $kcfinderSession;
	}
	/**
	* Show the form for creating a new slide
	*
	* @return Response
	*/
	public function index()
	{
		$this->_data['title']    = 'Đối tác'; 
		$this->_data['branchs']  = $this->mbranchs->getBranchs();
		$this->_data['temp']     = 'branchs/index';
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Show the form for creating a new slide
	*
	* @return Response
	*/
	public function create()
	{
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp']  = 'branchs/create';
		$this->load->library('form_validation');
		$img = TRUE;
		$rule = $this->mbranchs->rules;
		$this->form_validation->set_rules($rule['insert']);
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'ordering'	  => $this->input->post('ordering'),
				'title'       => $this->input->post('title'),
				'params'	  => json_encode($this->input->post('params')),
				'image'	  	  => $this->input->post('image'),
				'public'	  => $this->input->post('public'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			if ($img == TRUE)
			{
				$this->mbranchs->insert($data);
				$this->session->set_flashdata('success', 'Thêm mới thành công');
				redirect(base_url().'admin/branchs');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Show the form for creating a new slide
	*
	* @return Response
	*/
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			redirect(base_url().'admin/branchs');
		}
		$this->_data['title'] = 'Chỉnh sửa';
		$this->_data['temp']  = 'branchs/update';
		$this->load->library('form_validation');
		$img = TRUE;
		$this->_data['partner'] = $this->mbranchs->get_branch($id);
		$rule = $this->mbranchs->rules;
		$this->form_validation->set_rules($rule['insert']);
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'ordering'	  => $this->input->post('ordering'),
				'title'       => $this->input->post('title'),
				'params'	  => json_encode($this->input->post('params')),
				'public'	  => $this->input->post('public'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			if ($img == TRUE)
			{
				$this->mbranchs->update($data,array('id'=>$id));
				$this->session->set_flashdata('success', 'Thêm mới thành công');
				redirect(base_url().'admin/branchs');
			}
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	* Show the form for creating a new slide
	*
	* @return Response
	*/
	public function destroy($id)
	{
	    ///$this->mbranchs->deleteImage('image',array('id'=>$id),'/uploads/branchs/');
		$this->mbranchs->delete(array('id'=>$id));
		if ($this->input->is_ajax_request()) {
			echo "finish";
		}
	}
}

/* End of file branchs.php */
/* Location: ./application/modules/admin/controllers/branchs.php */