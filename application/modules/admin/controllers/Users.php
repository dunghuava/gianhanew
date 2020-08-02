<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Articles
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Users extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['menu','count_row']);
		$this->load->model(['musers','mrealestates']);
	}
	/**
	*
	*/
	public function index()
	{
		$column = 'users.id,users.username,users.display_name,roles.level,users.activated,users.block,roles.display_name as roles_name';
		$join = array('assigned_roles'=>'assigned_roles.user_id = users.id','roles'=>'roles.id = assigned_roles.role_id');
		$this->_data['users'] = $this->musers->get_all_table($column,$join);
		$this->_data['title'] = 'Thành viên';
		$this->_data['temp']  = 'users/index';
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	public function show($user_id)
	{
		$this->_data['title'] = 'Chi tiết';
		$this->_data['temp']  = 'users/show';
		$user = $this->musers->get_users_by_id($user_id);
		if (empty($user)) {
			$this->session->set_flashdata('error','Không tồn tại thành viên này.');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->_data['user'] = $user;
        $this->_data['realestates'] = $this->mrealestates->getRealestateUserId($user_id);
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	*
	*/
	public function create()
	{
		$this->load->helper('security');
		$this->_data['title'] = 'Thêm mới';
		$this->load->library('form_validation');
		$this->_data['temp']  = 'users/create';
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('display_name', 'tên hiển thị', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|max_length[100]|xss_clean|callback_check_user');
		$this->form_validation->set_rules('mobile', 'số điện thoại', 'trim|required');
		$this->form_validation->set_rules("email","Email","required|valid_email|callback_check_email");
		$this->form_validation->set_rules('password', 'mật khẩu', 'trim|required|max_length[100]|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'xác nhận mật khẩu', 'trim|required|max_length[100]|xss_clean');
		
		if ($this->form_validation->run() == TRUE)
		{
            $permissions = $this->input->post('permissions');
			$user = array(
				'display_name'	=>	$this->input->post('display_name'),
				'username'		=>	$this->input->post('username'),
				'email'			=>	$this->input->post('email'),
				'mobile'		=>  $this->input->post('mobile'),
				'address'		=>  $this->input->post('address'),
				'password'		=>	md5(sha1($this->input->post('password'))),
				'activated'     =>  $this->input->post('activated'),
				'block'    		=>  $this->input->post('blocked'),
				'created_at' 	=> 	date('Y-m-d H:i:s'),
				'updated_at' 	=> 	date('Y-m-d H:i:s'),
				'created_by' 	=> 	$this->session->userdata('user_id'),
				'updated_by' 	=> 	$this->session->userdata('user_id')
			);
			$user_id = $this->musers->insert($user);
			$this->load->model('massigned_roles');
			$this->massigned_roles->insert(array('user_id'=>$user_id,'role_id'=>$this->input->post('permissions')));
            // Send Mail
            $data = '<h2>Thông tin tài khoản tại s-nhadat.com</h2>
                     <hr>
                     <p>Tài Khoản: <strong>'.$this->input->post('username').'</strong></p>
                     <p>Mật khẩu : <strong>'.$this->input->post('password').'</strong></p>
                     <hr>
                     <p><small>Ngay bây giờ anh/chị hãy đăng tin sản phẩm của mình. Chúng tôi sẽ marketing hiệu quả cho sản phẩm của anh/chị.Nếu thư này có làm phiền anh/chị chúng tôi thành thật xin lỗi. Chúc anh/chị một ngày vui vẻ !</p></small>';
            
            $mail = new Mail();
            $mail->setMailBody($data);
            $mail->sendMail('Đăng ký tài khoản thành công !', $this->input->post('email'));
			$this->session->set_flashdata('success','Thêm mới thành công.');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}

	/**
	 * [update user]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	
	public function update($id)
	{
		$user_level = $this->session->userdata('user_level');
		$this->_data['title'] = 'Cập nhật thông tin tài khoản';
		$this->load->library('form_validation');
		$this->_data['temp']  = 'users/update';
		$user = $this->musers->get_users_by_id($id);
		if (empty($user)) {
			$this->session->set_flashdata('error','Không tồn tại thành viên này.');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->_data['user'] = $user;
        
		if ($user_level > $user['level']) {
			$this->session->set_flashdata('error','Bạn không có quyền chỉnh sửa tài khoản này.');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('display_name', 'tên hiển thị', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|max_length[100]|xss_clean|callback_check_user');
		$this->form_validation->set_rules('mobile', 'số điện thoại', 'trim|required');
		$this->form_validation->set_rules("email","Email","required|valid_email|callback_check_email");
		$this->form_validation->set_rules('password', 'mật khẩu', 'trim|max_length[100]|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'xác nhận mật khẩu', 'trim|max_length[100]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
		    $permissions = $this->input->post('permissions');
			$user_ins = array(
				'display_name'	=>	$this->input->post('display_name'),
				'username'		=>	$this->input->post('username'),
				'email'			=>	$this->input->post('email'),
				'mobile'		=>  $this->input->post('mobile'),
				'address'		=>  $this->input->post('address'),
				'activated'     =>  $this->input->post('activated'),
				'block'    		=>  $this->input->post('blocked'),
				'updated_at' 	=> 	date('Y-m-d H:i:s'),
				'updated_by' 	=> 	$this->session->userdata('user_id')
			); 
			if($this->input->post("password")){
				$user_ins['password']	=	md5(sha1($this->input->post('password')));
			}
			$this->musers->update($user_ins,array('id'=>$id));
			$level_user_login = $this->session->userdata('user_level');
			if ($user['level'] != 1)
			{
				$this->load->model('massigned_roles');
				$this->massigned_roles->update(array('role_id'=>$permissions),array('user_id'=>$id));
			}
			
			$this->session->set_flashdata('success','Cập nhật thành công !');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
	}
	/**
	 * [destroy user]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		$id_user_login    = $this->session->userdata('user_id');
		$level_user_login = $this->session->userdata('user_level');
		$user_deleted     = $this->musers->get_users_by_id($id);
		if (empty($user_deleted)) {
			$this->session->set_flashdata('error','Không tồn tại thành viên này.');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		if (isset($user_deleted) && $id_user_login == $user_deleted['id']) {
			# code...
			$this->session->set_flashdata('error', 'You can not delete your own');
			redirect(base_url().'admin/users');
		}
		// Truong hop tu xoa ban than
		if ((isset($user_deleted) && $user_deleted['level'] == $level_user_login) || $level_user_login > $user_deleted['level'])
		{
			$this->session->set_flashdata('error', 'Action Wrong');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		// Check user have article
		$this->load->model('marticles');
		$user_article = $this->marticles->checkUserHaveArticel($id);
		if ($user_article){
			$this->session->set_flashdata('error', 'Thành viên xóa còn bài viết !');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$user_real = $this->mrealestates->checkUserHaveReal($id);
		if ($user_real){
			$this->session->set_flashdata('error', 'Thành viên xóa còn rao vặt !');
			redirect(base_url().$this->_data['modules'].'/users');
		}
		$this->musers->delete(array('id'=>$id));
		$this->session->set_flashdata('success', 'Xóa thành viên thành công!');
		redirect(base_url().$this->_data['modules'].'/users');
	}
	/**
	 * [check_user description]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function check_user($user){
		$this->load->model("musers");
		$id=$this->uri->segment(4);
		if($this->musers->checkUsername($user,$id) == FALSE)
		{
			$this->form_validation->set_message("check_user","Username đã được đăng ký, vui lòng thử lại");
			return FALSE;
		}else{
			return TRUE;
		}	
	}
	/**
	 * check_email description
	 * @param  [type] $email [description]
	 * @param  [type] $id    [description]
	 * @return [type]        [description]
	 */
	public function check_email($email,$id){
		$this->load->model("musers");
		$id=$this->uri->segment(4);	
		if($this->musers->checkEmail($email,$id) == FALSE){
			$this->form_validation->set_message("check_email","E-mail đã được đăng ký, vui lòng nhập email khác");
			return FALSE;
		}else{
			return TRUE;
		}	
	}
}
/* End my_application/modules/admin/controller/users.php*/
