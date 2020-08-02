<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_size extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mshopping_size');
	}
	public function index()
	{
		$this->_data['title'] = 'Danh sách Size sản phẩm';
		$this->_data['temp']  = 'shopping_size/index';
		$this->_data['sizes'] = $this->mshopping_size->getSizes();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	public function create()
	{
		$this->_data['title'] = 'Thêm Size sản phẩm';
		$this->_data['temp']  = 'shopping_size/create';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên size', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'trim|required||xss_clean|numeric');
		if ($this->form_validation->run() == TRUE)
		{
			$size = array(
				'title'       => $this->input->post('title'),
				'summary'     => $this->input->post('summary'),
				'ordering' 	  => $this->input->post('ordering'),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->session->userdata('user_id'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			$this->mshopping_size->insert($size);
			$this->session->set_flashdata('success', 'Thao tác thành công');
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)){
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$size = $this->mshopping_size->getSize($id);
		if (empty($size)) {
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$this->_data['title'] = 'Cập nhật Size sản phẩm';
		$this->_data['size']  = $size;
		$this->_data['temp']  = 'shopping_size/update';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'tên size', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ordering', 'thứ tự', 'trim|required||xss_clean|numeric');
		if ($this->form_validation->run() == TRUE)
		{
			$size = array(
				'title'       => $this->input->post('title'),
				'summary'     => $this->input->post('summary'),
				'ordering' 	  => $this->input->post('ordering'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'updated_by'  => $this->session->userdata('user_id')
			);
			$this->mshopping_size->update($size,array('id'=>$id));
			$this->session->set_flashdata('success', 'Thao tác thành công');
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)){
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$shopping_products = $this->db->where('size_id', $id)->get('shopping_products')->num_rows();
		if($shopping_products > 0)
		{
			$this->session->set_flashdata('error', 'Đơn vị này không thể xóa do đã có sản phẩm sử dụng thông tin này');
			redirect(base_url().$this->_data['modules'].'/shopping_size');
		}
		$this->mshopping_size->delete(array('id'=>$id));
		$this->session->set_flashdata('success', 'Xóa đơn vị thành công');
		redirect(base_url().$this->_data['modules'].'/shopping_size');
	}
}

/* End of file shopping_size.php */
/* Location: ./application/modules/admin/controllers/shopping_size.php */