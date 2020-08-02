<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*****************************************************
*     Tiết Kiệm Chi Phí Với Giải Pháp Mới           *
*     Email:    quochieuhcm@gmail.com               *
*     Skype:    quochieuhcm                         *
*     Tel  :    0949.133.224                        *
*     Website:  www.qhweb.biz                       *
*****************************************************
* Contacts Controller
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com  | 0949.133.224
* @copyright 2015
*/
class Contacts extends AdminController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('unicode','menu'));
		$this->load->model(['mcontacts','mcategory']);
	}
	/**
	 * Show list
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->_data['title']    = 'Danh sách';
		$this->_data['temp']     = 'contacts/index';
		$this->_data['contacts'] = $this->mcontacts->getList();
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Create Contact
	 * 
	 * @return [type] [description]
	 */
	public function create()
	{
		$img = TRUE;
		$this->_data['title'] = 'Thêm mới';
		$this->_data['temp'] = 'contacts/create';
		$this->load->library('form_validation');
		$this->_data['category'] = $this->mcategory->get_all_categories('contact');
		$this->form_validation->set_rules('title', 'tên liên hệ', 'trim|required|min_length[5]|max_length[110]');
		$this->form_validation->set_rules('title_alias', 'url', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[5]');
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'category_id' => $this->input->post('category_id'),
				'title' 	  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'email' 	  => $this->input->post('email'),
				'public'      => $this->input->post('public'),
				'params'      => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']

			);
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title_alias')));
				$config['upload_path'] 		= './uploads/contacts/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}else{
					$images = $this->upload->data();
					$data['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			$this->mcontacts->insert($data);
			$this->session->set_flashdata('success', 'Thêm mới thành công !');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * Update Contact
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function update($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Có lỗi xảy ra');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		$contact = $this->mcontacts->getById($id);
		if (empty($contact)) {
			$this->session->set_flashdata('error', 'Không tồn tại dữ liệu');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		$img = TRUE;
		$this->_data['title']   = 'Cập nhật';
		$this->_data['temp']    = 'contacts/update';
		$this->_data['contact'] = $contact;
		$this->load->library('form_validation');
		$this->_data['category'] = $this->mcategory->get_all_categories('contact');
		$this->form_validation->set_rules('title', 'tên liên hệ', 'trim|required|min_length[5]|max_length[110]');
		$this->form_validation->set_rules('title_alias', 'url', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[5]');
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'category_id' => $this->input->post('category_id'),
				'title' 	  => $this->input->post('title'),
				'title_alias' => $this->input->post('title_alias'),
				'email' 	  => $this->input->post('email'),
				'public'      => $this->input->post('public'),
				'params'      => json_encode($this->input->post('params'),JSON_UNESCAPED_UNICODE),
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']

			);
			if ($_FILES['image']['name'] != "") {
				$config['file_name'] 		= convert_file_to_date($_FILES['image']['name'],make_unicode($this->input->post('title_alias')));
				$config['upload_path'] 		= './uploads/contacts/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']  	 	= '1024';
				$config['max_width']  		= '*';
				$config['max_height']  		= '*';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')){
					$this->_data['error'] = $this->upload->display_errors();
					$img = FALSE;
				}else{
					$images = $this->upload->data();
					$this->mcontacts->deleteImage('image',['id' => $id],'/uploads/contacts/');
					$data['image'] = $images['file_name'];
					$img = TRUE;
				}
			}
			$this->mcontacts->update($data,['id'=>$id]);
			$this->session->set_flashdata('success', 'Cập nhật thành công !');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 *
	 * Destroy Contact
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		if (!isset($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Có lỗi xảy ra');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		$contact = $this->mcontacts->getById($id);
		if (empty($contact)) {
			$this->session->set_flashdata('error', 'Không tồn tại dữ liệu');
			redirect(base_url().$this->_data['modules'].'/contacts');
		}
		$this->session->set_flashdata('success', 'Xóa danh bạ thành công !');
		redirect(base_url().$this->_data['modules'].'/contacts');
	}

}

/* End of file Contacts.php */
/* Location: ./application/modules/admin/controllers/Contacts.php */