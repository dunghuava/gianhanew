<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends DefaultController
{
	protected $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['default/membership_model','default/realestate_model']);
		$this->users_id = $this->session->userdata('user_id');
        $this->load->library('captcha');
	}
	// Trang cá nhân
	public function index()
	{
		$this->checkLogin();
		$this->_data['meta_title']		= 'Trang có nhân';
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['temp']            = 'users/index';
		$this->load->library('pagination');
		$config['base_url'] = base_url().'thanh-vien/quan-ly-tin-rao/trang/';
		$config['total_rows'] = $this->realestate_model->countGetRealestates($this->users_id);
		$config['per_page'] = 15;
		$config['uri_segment'] = 4;
		$page = $this->uri->segment(4);
		$config['num_links'] 	   = REALESTATE_PAGE_PER_SEGMENT;
		$this->_config_pagination();
		$this->pagination->initialize($config);
		$this->_data['my_realestates'] = $this->realestate_model->getRealestates($this->users_id,$config['per_page'],$page);
		$this->_data['link'] = $this->pagination->create_links();
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	// Config Pagination
	public function _config_pagination()
	{
		$config['full_tag_open'] = '<nav id="pagination" style="display:inline-block;"><ul class="pagination my-pagination pull-right">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = false;
        $config['last_link']  = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Trang sau';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
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
	// Login
	public function login()
	{
		$this->isLogined();
		$this->_data['meta_title']		= "Đăng nhập";
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['temp']      = 'users/login';
		// Form Validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'tài khoản !', 'trim|required|min_length[5]|max_length[120]|xss_clean');
		$this->form_validation->set_rules('password', 'mật khẩu !', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$this->load->helper('security');
			$username = $this->input->post('username');
			$password = md5(sha1(($this->input->post('password'))));
			$data = $this->membership_model->check_login($username,$password);
			//var_dump($data);die;
			if($data == false)
			{
				$this->_data['error'] = 'Thông tin đăng nhập không chính xác';
			}else{
				$sess = array(
					"username"		=> $data['username'],
					"display_name"	=> $data['display_name'],
					"user_id"	   	=> $data['user_id'],
					"user_level"	=> $data['level']
				);
				$this->session->set_userdata($sess);
				$this->load->model('musertrackers');
				/**
				* INSERT HISTORY LOGIN
				*/
				$this->musertrackers->insert(
					array(
						'user_id'	  => $this->session->userdata('user_id'),
						'browser'     => $_SERVER['HTTP_USER_AGENT'],
						'ip_address'  => $_SERVER['REMOTE_ADDR'],
						'created_at'  => date('Y-m-d H:i:s'),
						'updated_at'  => date('Y-m-d H:i:s')
					)
				);
				$this->session->set_flashdata('success','Đăng nhập thành công !. Bạn có thể sử dụng các chức năng');
				redirect(base_url().'thanh-vien/quan-ly-tin-rao.htm');
			}
		}
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	public function register()
	{
	    $this->_data['captcha']         = $this->captcha->make_captcha();
		$this->_data['meta_title']		= "Đăng ký thành viên";
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['temp']            = 'users/register';
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules("display_name",'tên hiển thị',"required");
		$this->form_validation->set_rules("username",'tài khoản',"required|min_length[5]|callback_check_user");
		$this->form_validation->set_rules('password', 'mật khẩu',  'trim|required|min_length[5]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'xác nhận mật khẩu', 'trim|required|xss_clean|matches[password]');
		$this->form_validation->set_rules('mobile', 'điện thoại', 'trim|required|xss_clean|is_numeric|min_length[10]|max_length[11]|callback_check_phone');
		$this->form_validation->set_rules('email', 'e-mail', 'trim|required|xss_clean|valid_email|callback_check_email');
		if ($this->form_validation->run() == TRUE)
		{
			$user = [
				'display_name'	=>	$this->input->post('display_name'),
				'username'		=>	$this->input->post('username'),
				'email'			=>	$this->input->post('email'),
				'mobile'		=>	$this->input->post('mobile'),
                'address'		=>	$this->input->post('address'),
				'password'		=>	md5(sha1($this->input->post('password'))),
				'confirmation_code' =>do_hash($this->input->post('email')),
				'activated'     =>  1,
				'block'    		=>  0,
				'created_at' 	=> 	date('Y-m-d H:i:s'),
				'updated_at' 	=> 	date('Y-m-d H:i:s'),
			];
			$user_id = $this->membership_model->insert($user);
			$this->load->model('massigned_roles');
			// Thêm vào Roles
			$this->massigned_roles->insert(
				array(
					'user_id'=> $user_id,
					'role_id'=> 4
				)
			);
            $sess = array(
					"username"		=> $this->input->post('username'),
					"display_name"	=> $this->input->post('display_name'),
					"user_id"	   	=> $user_id,
					"user_level"	=> 4
			);
            $this->session->set_userdata($sess);
            $data = '<h2>Thông tin tài khoản tại ĐĂNG TIN NHÀ ĐẤT - www.dangtinnhadat.net</h2>
                     <hr>
                     <p>Tài Khoản: <strong>'.$this->input->post('username').'</strong></p>
                     <p>Mật khẩu : <strong>'.$this->input->post('password').'</strong></p>
					 <p>Chú ý: QUÝ KHÁCH ĐƯỢC ĐĂNG TIN THƯỜNG MIỄN PHÍ. ĐỂ ĐƯỢC ĐĂNG TIN VIP TỪ HỆ THỐNG VUI LÒNG GỌI HOTLINE 0943.29.29.09</p>
                     <hr>
                     <p><small>Ngay bây giờ anh/chị hãy đăng tin sản phẩm của mình. Chúng tôi sẽ marketing hiệu quả cho sản phẩm của anh/chị.Nếu thư này có làm phiền anh/chị chúng tôi thành thật xin lỗi. Chúc anh/chị một ngày vui vẻ !</p></small>';
            
            $mail = new Mail();
            $mail->setMailBody($data);
            $mail->sendMail('Đăng ký tài khoản thành công !', $this->input->post('email'));
			$this->session->set_flashdata('success', 'Bạn đã đăng ký thành công ! Vui lòng kiểm tra inbox/spam email để hoàn tất');
			// Sau khi insert thành công
			redirect(base_url().'thanh-vien/quan-ly-tin-rao.htm');
		}
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	// Change Info
	public function reInfo()
	{
		$this->checkLogin();
		$this->_data['meta_title']		 = 'Thay đổi thông tin cá nhân';
		$this->_data['meta_description'] = SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	 = SITE_KEYWORDS;
		$this->_data['meta_image']	  	 = LOGOSITE;
		$this->_data['temp']             = 'users/info';
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_rules('display_name', 'tên hiển thị', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('mobile', 'số điện thoại', 'trim|required|xss_clean|is_numeric|min_length[10]|max_length[11]|callback_check_phone');
		$this->form_validation->set_rules('address', 'địa chỉ', 'trim|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$userUp = [
				'display_name'  => $this->input->post('display_name'),
				'mobile'		=> $this->input->post('mobile'),
				'address'		=> $this->input->post('address')
			];
			$this->membership_model->update($userUp,['id'=>$this->session->userdata('user_id')]);
			$this->session->set_flashdata('success', 'Cập nhật thành công !');
			redirect(base_url().'thanh-vien/thay-doi-thong-tin.htm');
		}
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	public function inbox()
	{
		$this->checkLogin();
		$this->_data['meta_title']		= 'Hộp thư';
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['temp']            = 'users/inbox';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	* Change Password
	*/
	public function change_password()
	{
		$this->checkLogin();
		$this->_data['meta_title']		= 'Thay đổi mật khẩu ';
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image']	  	= LOGOSITE;
		$this->_data['temp']            = 'users/password';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_password', 'mật khẩu cũ', 'trim|required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('password', 'mật khẩu cũ mới', 'trim|required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'xác nhận mật khẩu mới', 'trim|required|matches[password]|xss_clean');
		if ($this->form_validation->run() == TRUE){
			$userID = $this->session->userdata('user_id');
			$password = md5(sha1($this->input->post('old_password')));
			$users = $this->membership_model->check_password_old($userID,$password);
			if ($users) {
				$pass = [
					'password' => md5(sha1($this->input->post('password')))
				];
				$this->membership_model->update($data,['id'=>$userID]);
				$this->session->set_flashdata('success', 'Thay đổi mật khẩu thành công !');
				redirect(base_url().'admin');
			}else{
				// Sai thông báo lỗi ra ngoài
				$this->_data['error'] = 'Vui lòng kiểm tra lại thông tin.';
			}
			
			$this->membership_model->update($pass,['id'=>$this->session->userdata('user_id')]);
			session_destroy();
			$this->session->set_flashdata('success', 'Thay đổi mật khẩu thành công !');
			redirect(base_url().'dang-nhap.htm');
		}
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	// Logout
	public function sign_out()
	{
		@session_start();
		session_destroy();
		redirect(base_url());
	}
	/**
	 * GET INFO AJAX
	 */
	public function info()
	{
		if($this->input->is_ajax_request())
		{
			$users_id = toInternalId($this->input->get('handuser'));
			$data = $this->membership_model->getInfomation($users_id);
			if (!empty($data)) {
				echo json_encode($data);
			}
		}
	}
	/**
     * 
     * Kiểm tra username đã tồn tại hay chưa ? 
     * 
     * @return Boolean
     */
    public function check_user($user,$id)
	{
		$this->load->model("musers");
		if($this->membership_model->checkUsername($user,$id) == FALSE){
			$this->form_validation->set_message("check_user","Tài khoản không phù hợp, vui lòng chọn tài khoản khác");
			return FALSE;
		}else{
			return TRUE;
		}	
	}
    /**
     * 
     * Kiểm tra email đã tồn tại hay chưa ? 
     * 
     * @return Boolean
     */
    public function check_email($email,$id)
	{
		if($this->membership_model->checkEmail($email,$id) == FALSE){
			$this->form_validation->set_message("check_email","Email đã được sử dụng, vui lòng thử email khác");
			return FALSE;
		}else{
			return TRUE;
		}	
	}
    /**
     * 
     * Kiểm tra số điện thoại đã tồn tại hay chưa
     * 
     * @return Boolean
     */
    public function check_phone($phone,$id)
	{
		$id = $this->session->userdata('user_id');
		if($this->membership_model->checkPhone($phone,$id) == FALSE)
		{
			$this->form_validation->set_message("check_phone","Số điện thoại đã được sử dụng, vui lòng thử lại");
			return FALSE;
		}else{
			return TRUE;
		}
	}
    public function fotget_password(){
        $this->isLogined();
		$this->_data['meta_title'] = 'Quên mật khẩu | ĐĂNG TIN NHÀ ĐẤT';
		$this->_data['meta_description']= SITE_DESCRIPTION;
		$this->_data['meta_keywords'] 	= SITE_KEYWORDS;
		$this->_data['meta_image'] = LOGOSITE;
		$this->_data['temp'] = 'users/fotget_password';
        // Form Validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email !', 'trim|required|min_length[5]|max_length[120]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post('email');
            $validation_email = $this->membership_model->getEmail($email);
            if($validation_email){
                $data = '<h2>Quên mật khẩu</h2>
                         <hr>
                         <p>Chào bạn '.$validation_email->display_name.'</p>
                         <p>Cảm ơn bạn đã sử dụng dịch của ĐĂNG TIN NHÀ ĐẤT</p>
                         <p> Để thay đổi mật khẩu của tài khoản, bạn vui lòng kích vào đường dẫn dưới đây (hoặc sao chép và dán vào thanh địa chỉ của trình duyệt) : '.base_url().'lay-lai-mat-khau/UserId-'.toPublicId($validation_email->id).'/ActivationCode-'.$validation_email->confirmation_code.'</p>
                         <p>Thông tin tài khoản của bạn:</p><br>
                         <p>Tên đăng nhập: '.$validation_email->username.'</p>
                         <p>Xin vui lòng liên lạc với chúng tôi nếu Quý khách cần thêm thông tin.</p>
                         <p>(*) Đây là email tự động. Việc hồi âm cho địa chỉ email này sẽ không được ghi nhận.</p>
                         <br>
                         <p>Trân trọng,<p>';
                
                $mail = new Mail();
                $mail->setMailBody($data);
                $debug = $mail->sendMail('Thông báo đổi mật khẩu trên ĐĂNG TIN NHÀ ĐẤT', $email);
                if($debug){
                    $this->session->set_flashdata('success','Bạn vui lòng kiểm tra email và thực hiện theo hướng dẫn. 
Bạn vui lòng kiểm tra cả thùng thư rác (Spam)');
                }else{
                	 $this->session->set_flashdata('error','Đã có lỗi xảy ra !');
                }
            }else{
            	 $this->session->set_flashdata('error','E-mail không tồn tại !');
            }
            redirect(base_url().'quen-mat-khau.htm');
		}
        $this->load->view($this->_data['modules'].'/template', $this->_data);
    }
    // Check Rest Password
    public function reset_password($userid,$confirmation_code)
    {
        if(!isset($userid) || !isset($confirmation_code)){
            $this->session->set_flashdata('error','Đã có lỗi xảy ra !');
            redirect(base_url().'quen-mat-khau.htm');
        }
        $string_userid = explode('-',$userid);
        $string_confirmation_code = explode('-',$confirmation_code);
        if(isset($string_userid[1]) && !empty($string_userid[1])){
            $userid = toInternalId($string_userid[1]);
        }else{
            $this->session->set_flashdata('error','Đã có lỗi xảy ra !');
            redirect(base_url().'quen-mat-khau.htm');
        }
        if(isset($string_confirmation_code[1]) && !empty($string_confirmation_code[1])){
            $get_confirmation_code = trim($string_confirmation_code[1]);
        }else{
            $this->session->set_flashdata('error','Đã có lỗi xảy ra !');
            redirect(base_url().'quen-mat-khau.htm');
        }
        if($userid && $get_confirmation_code)
        {
            $this->_data['meta_title'] = 'Đổi mật khẩu | ĐĂNG TIN NHÀ ĐẤT';
    		$this->_data['meta_description']= SITE_DESCRIPTION;
    		$this->_data['meta_keywords'] = SITE_KEYWORDS;
    		$this->_data['meta_image'] = LOGOSITE;
    		$this->_data['temp'] = 'users/reset_password';
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'mật khẩu',  'trim|required|min_length[5]|max_length[50]|xss_clean');
		    $this->form_validation->set_rules('confirm_password', 'xác nhận mật khẩu', 'trim|required|xss_clean|matches[password]');
    		if ($this->form_validation->run() == TRUE)
    		{
    		   
    		   $check = $this->membership_model->checkIdAndCode($userid,$get_confirmation_code);
               if($check)
               {
                    $this->membership_model->update(['password' => md5(sha1($this->input->post('password')))],['id' => $userid]);
                    $this->session->set_flashdata('success','Thay đổi mật khẩu thành công !');
                    redirect(base_url().'dang-nhap.htm');
               }else{
                    $this->_data['error'] = 'Vui lòng kiểm tra lại !';
               }
            }
            $this->load->view($this->_data['modules'].'/template', $this->_data);
        }else{
            $this->session->set_flashdata('error','Đã có lỗi xảy ra !');
            redirect(base_url().'quen-mat-khau.htm');
        }
    }
}

/* End of file User.php */
/* Location: ./application/modules/default/controllers/User.php */