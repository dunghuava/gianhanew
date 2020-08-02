<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends DefaultController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mprojects','mcategory','mprovinces','mdistricts']);
		$this->_data['projects_cate'] = $this->mcategory->showCategoriesParent('project');
		$this->_data['provinces'] = $this->mprovinces->allProvinces();
	}

	/**
	 *  Switch tìm kiếm dự án
	 */
	public function findProject(){
		if ($this->input->post('btnFindProject')){
			$category_id = $this->input->post('sltProjectCate');
			$infoCate = $this->mcategory->getCateInfo($category_id);
			if (empty($infoCate)) {
				redirect(base_url());
			}
			$district_id = $this->input->post('sltProjectDistrict');
			$province_id = $this->input->post('sltProjectProvince');
			if ($province_id != -1 && $province_id != 0)
			{
				$province = $this->mprovinces->getProvince($province_id);
				if ($district_id != -1 && $district_id != 0)
				{
					$url = base_url().'du-an/'.$infoCate->title_alias;
					$district = $this->mdistricts->getDistrict($district_id);
					$url .='/'.$province->slug_name.'/'.$district->slug_name.'-qh'.toPublicId($district->district_id) ;
				}else{
					$url  = base_url().'du-an/'.$infoCate->title_alias;
					$url .='/'.$province->slug_name.'-tp'.toPublicId($province->province_id);
				}
				$url .='.htm';
			}else{
				$url = base_url().$infoCate->title_alias;
			}
			redirect($url);
		}
	}
	// View By District
	public function getProjectByDistrict($cate_slug,$province_slug='',$district_slug='',$district_id)
	{
		if (!isset($district_id) || !is_numeric($district_id) || !isset($cate_slug)) {
			redirect(base_url());
		}
		$checkCate = $this->mcategory->checkCate($cate_slug);
		if (empty($checkCate)) {
			redirect(base_url());
		}
		$district = $this->mdistricts->getDistrict(toInternalId($district_id));
		if (empty($district)){
			redirect(base_url());
		}
		if ($checkCate->component == 'project'){
			$this->_data['title_hasParentCates']  = 'Danh mục dự án';
			$this->_data['hasParentCates']    = $this->mcategory->getHasParent($checkCate->id);
			$this->_data['category']  = $checkCate;
			$this->_data['district']  = $district;
			$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($district->province_id);
			$this->_data['meta_title'] 		 = $checkCate->title .' '. $district->name;
			$this->_data['meta_description'] = json_decode($checkCate->params)->meta_description;
			$this->_data['meta_keywords']    = json_decode($checkCate->params)->meta_keywords;
			if (!empty($checkCate->image))
			{
				$this->_data['meta_image'] = base_url().'uploads/category/'.$checkCate->image;
			}else{
				$this->_data['meta_image'] = LOGOSITE;
			}
			$this->_data['projects']  = $this->mprojects->mfindProjectDistrict($checkCate->id,toInternalId($district_id));

			$this->_data['temp'] 	 = 'projects/project_district';
			$this->load->view($this->_data['modules'].'/template', $this->_data);
		}else{
			redirect(base_url());
		}
	}
	/**
	 * Hiển thị danh sách dự án theo tỉnh/thành
	 * 
	 * @param  [string] $cate_slug     [description]
	 * @param  [string] $province_slug [description]
	 * @param  [int] $province_id   [description]
	 * @return [type]                [description]
	 */
	public function getProjectByProvince($cate_slug,$province_slug,$province_id)
	{
		if (!isset($province_id) || !is_numeric($province_id) || !isset($cate_slug)) {
			show_404();
		}
		$checkCate = $this->mcategory->checkCate($cate_slug);
		if (empty($checkCate)) {
			show_404();
		}
		$province = $this->mprovinces->getProvince(toInternalId($province_id));
		if (empty($province)){
			redirect(base_url().$cate_slug);
		}
		if ($checkCate->component == 'project')
		{
			$this->_data['title_hasParentCates']  = 'Danh mục dự án';
			$this->_data['hasParentCates']    = $this->mcategory->getHasParent($checkCate->id);
			$this->_data['category']  = $checkCate;
			$this->_data['province_c']= $province;
			$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($province->province_id);
			// SEO
			$this->_data['meta_title'] = $checkCate->title .' tại '. $province->name;
			$this->_data['meta_description'] = json_decode($checkCate->params)->meta_description;
			$this->_data['meta_keywords'] = $checkCate->title .' tại '. $province->name.', '.json_decode($checkCate->params)->meta_keywords;
			$this->_data['meta_image'] = !empty($checkCate->image) ? base_url().'uploads/category/'.$checkCate->image : LOGOSITE ;
			// END SEO
			// 
			if(isset($_GET['p']) && !empty($_GET['p']))
				$page= (int) $_GET['p'];   
			else
				$page= 0;
			$this->load->library('pagination');
			$config['base_url'] 	   = base_url().'du-an/'.$cate_slug.'/'.$province_slug.'-tp'.$province_id.'.htm';
			$config['total_rows'] 	   = $this->mprojects->count_getProjectsByProvinceID($checkCate->id,toInternalId($province_id));
			$config['per_page'] 	   = PROJECT_RECORD_PER_PAGE;
			$config['uri_segment'] 	   = 3;
			$config['num_links'] 	   = PROJECT_PAGE_PER_SEGMENT;
			$this->_config_pagination();
			$this->pagination->initialize($config);

			$this->_data['projects'] = $this->mprojects->mfindProjectProvince($checkCate->id,toInternalId($province_id),$config['per_page'],$page);
			$this->_data['link']  = $this->pagination->create_links();
			$this->_data['temp'] = 'projects/project_province';
			$this->load->view($this->_data['modules'].'/template', $this->_data);
		}else{
			redirect(base_url());
		}
	}

	public function searchGetProject()
	{
		$this->_data['meta_title'] = 'Mua bán căn hộ giá rẻ TPHCM, Cho thuê căn hộ giá rẻ TPHCM';
		$this->_data['meta_description'] = 'Mua bán căn hộ giá rẻ TPHCM, Cho thuê căn hộ giá rẻ TPHCM';
		$this->_data['meta_keywords'] = 'Mua bán căn hộ giá rẻ TPHCM, Cho thuê căn hộ giá rẻ TPHCM';
		$this->_data['meta_image']	 = LOGOSITE;
		$this->_data['temp'] = 'projects/tim-kiem';
		// Begin search
		$s = $this->input->get('s');
		$type = isset($_GET['type']) ? (int)$_GET['type'] : 0;
		$city = isset($_GET['city']) ? (int)$_GET['city'] : 0;
		$district = isset($_GET['district']) ? (int)$_GET['district'] : 0;
		if(isset($_GET['p']) && !empty($_GET['p']))
			$page= (int) $_GET['p'];   
		else
			$page= 0;
		$this->load->library('pagination');
		$config['base_url'] 	   = base_url().'tim-du-an?s='.$s.'&type='.$type.'&city='.$city.'&district='.$district;
		$config['total_rows'] 	   = $this->mprojects->countSearchProject($s,$type,$city,$district);
		$config['per_page'] 	   = PROJECT_RECORD_PER_PAGE;
		$config['uri_segment'] 	   = 3;
		$config['num_links'] 	   = PROJECT_PAGE_PER_SEGMENT;
		$this->_config_pagination();
		$this->pagination->initialize($config);

		$this->_data['projects'] = $this->mprojects->searchProject($s,$type,$city,$district,$config['per_page'],$page);
		$this->_data['link']  = $this->pagination->create_links();
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	 * [_config_pagination description]
	 * 
	 * @return [type] [description]
	 */
	public function _config_pagination()
	{
		$config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'p';
		$config['full_tag_open'] = '<nav id="pagination"><ul class="pagination my-pagination pull-right">';
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

	public function save_consult()
	{
		if ($this->input->is_ajax_request()) {
			$name_user    = $this->input->post('name');
			$apartment_id = $this->input->post('apartment_id');
			$name_phone   = $this->input->post('phone');
			$name_email   = $this->input->post('email');
			$name_content = $this->input->post('content');
			$contact_id   = $this->input->post('contact_id');
			$like_id = $this->input->post('like_id');
			if ($contact = $this->mcontacts->getContact($contact_id)){
				$data = [
					'HOTEN'   => $name_user,
					'SDT' 	  => $name_phone,
					'EMAIl'   => $name_email,
					'CONTENT' => $name_content,
					'LIKE'	  => $like_id
				];
				$mail = new Mail();
				$template = 'project.html';
				$mail->setMailBody($data,$template);
				$debug = $mail->sendMail($contact->title, $contact->email);
				if($debug){
					echo json_encode([
						'status' => 200,
						'msg'    => 'Cảm ơn bạn đã liên hệ!'
					]);
				}else{
					echo json_encode([
						'status' => 400,
						'msg'    => 'Đã có lỗi xảy ra, vui lòng thử lại'
					]);
				}
			}else{
				echo json_encode([
					'status' => 400,
					'msg'    => 'Đã có lỗi xảy xin vui lòng gọi số HOTLINE'
				]);
			}
			
		}
	}
}

/* End of file project.php */
/* Location: ./application/modules/default/controllers/project.php */