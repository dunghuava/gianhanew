<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realestate extends DefaultController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['default/realestate_model','mcategory','mprovinces','mdistricts','mrealestate_gallerys','mrealestate_project']);
	}
	/**
	 * SHOW REAl BY ID
	 */
	public function showRealestateById($cate,$realestate_slug ='',$rID)
	{
		if (!isset($rID) || !is_numeric($rID)){
			redirect(base_url().$cate);
		}
		$checkCate = $this->mcategory->checkCate($cate);
		if (empty($checkCate)) {
			redirect(base_url());
		}
		$this->_data['category'] = $checkCate;
		$realestate = $this->realestate_model->showID($rID);
		if (empty($realestate)) {
			redirect(base_url().$cate);
		}
        $this->_data['advertings'] = $this->madvertings->getAdvertingInPage($checkCate->group_id);
		//mrealestate_gallerys
		$this->_data['gallerys'] = $this->mrealestate_gallerys->getRealestateGallerys($rID);
		$this->_data['realestate'] = $realestate;
		$this->_data['meta_title'] = $realestate->title;
		$this->_data['meta_description']= isset(json_decode($realestate->params)->meta_description) ? json_decode($realestate->params)->meta_description : trim(preg_replace("/\\n/m", " ", stripString($realestate->content,170)));
		$this->_data['meta_keywords'] = isset(json_decode($realestate->params)->meta_keywords) ? json_decode($realestate->params)->meta_keywords : $realestate->title;
        $thumbnail = getThumbnail($realestate->id);
		if (!empty($thumbnail)){
			$this->_data['meta_image']	= base_url().'uploads/properties/'.getThumbnail($realestate->id);
		}else{
			$this->_data['meta_image']	= LOGOSITE;
		}
		$checkCate = $this->db->select('id,parent_id')
							  ->where('id',$realestate->category_id)->get('categories')->row();
		if (!empty($checkCate)) {
			$this->_data['hasParentCates'] = $this->mcategory->hasParent($realestate->category_id,$checkCate->parent_id);
		}
        $this->_data['Rprojects'] = $this->mrealestate_project->getProjectByDisId($realestate->district_id);
		// District
		$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($realestate->province_id);
        // Same other
		$this->_data['sames'] = $this->realestate_model->getRealestateSameDistrict($realestate->id,$realestate->category_id,$realestate->district_id);
		$this->_data['temp'] = 'realestates/view_realestate';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	 * Get list realestate by province id
	 * 
	 * 
	 * @param  string  $cate   [description]
	 * @param  string  $d_slug [description]
	 * @param  [type]  $pId    [description]
	 * @param  integer $page   [description]
	 * @return [type]          [description]
	 */
	public function showRealestateByProvince($cate = '', $d_slug = '',$pId)
	{
		if (!isset($pId) || !is_numeric($pId)) {
			redirect(base_url().$cate);
		}
		// check Provinces
		$province = $this->mprovinces->getProvince(toInternalId($pId));
		if (empty($province)) {
			redirect(base_url().$cate);
		}
		// Check Cate
		$checkCate = $this->mcategory->checkCate($cate);
		if (empty($checkCate)){
			show_404();
		}
		$where = '';
		$direct= isset($_GET['direct']) ? (int)$_GET['direct'] : '0';
		$price = isset($_GET['price']) ? (int)$_GET['price'] : '0';
		$area  = isset($_GET['area']) ? (int)$_GET['area'] : '0';
		$unit  = isset($_GET['unit']) ? (int)$_GET['unit'] : '0';
		$URI = "?direct=$direct&price=$price&area=$area&unit=$unit";
		if ($direct != 0)
			$where .= 'AND home_direction='.$direct;
		if ($price != 0)
			$where .= ' AND price ='.$price;
		if ($area != 0)
			$where.= ' AND area ='.$area;
		if ($unit != 0)
			$where .= ' AND price_type ='.$unit;
		if(isset($_GET['p']) && !empty($_GET['p']))
			$page= (int) $_GET['p'];   
		else
			$page= 0;
		$this->_data['title_hasParentCates']  = 'Xem thêm danh mục';
		$this->_data['category'] = $checkCate;
		$this->_data['province'] = $province;
		$this->_data['hasParentCates'] = $this->mcategory->hasParent($checkCate->id,$checkCate->parent_id);
        $condition ='';
		if ($checkCate->parent_id == 0)
		{
			$get_cate_child = $this->db->select('id')
									   ->where('parent_id',$checkCate->id)
									   ->get('categories')
									   ->result();
			if (!empty($get_cate_child)) {
				foreach ($get_cate_child as $k => $item) {
					$condition[$k] = $item->id;
				}
				$condition[] = $checkCate->id;
			}else{
				$condition = $checkCate->id;
			}
		}else{
			$condition = $checkCate->id;
		}
		$this->_data['meta_title'] = str_replace(',',' ', $checkCate->title) .' '.$province->name . ' | ' . str_replace(',',' ',$checkCate->title) .' tại '.$province->name;
		$this->_data['meta_description'] = $checkCate->title .' '.$province->name.', '.unicode2($checkCate->title .' '.$province->name).','.json_decode($checkCate->params)->meta_description;
		$this->_data['meta_keywords']    = str_replace(' ',',', $checkCate->title .' '.$province->name.','.unicode2($checkCate->title .' '.$province->name));
		$this->_data['meta_image'] = !empty($checkCate->image) ? base_url().'uploads/category/'.$checkCate->image : LOGOSITE;

		$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($province->province_id);
		// data
        $this->_data['category'] = $checkCate;
		$this->load->library('pagination');
		$config['base_url']	= base_url().$cate.'/'.$d_slug.'-tp'.$pId.'.htm'.$URI;
		$config['total_rows'] = $this->realestate_model->countRealestateByProvinceId($condition,toInternalId($pId),$where);
		$config['per_page'] = REALESTATE_RECORD_PER_PAGE;
		$config['uri_segment'] = 5;
		$config['num_links'] = REALESTATE_PAGE_PER_SEGMENT;
		$this->_config_pagination();
		$this->pagination->initialize($config);
		$this->_data['realestates'] = $this->realestate_model->getRealestateByProvinceId($condition,toInternalId($pId),$config['per_page'],$page,$where);
		$this->_data['link'] = $this->pagination->create_links();
		$this->_data['temp'] = 'realestates/provinces';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
	/**
	 * SHOW REAL BY DISTRICT
	 */
	public function showRealestateByDistrict($cate ='', $p_slug='' ,$d_slug)
	{
		if (!isset($d_slug) || !is_string($d_slug)) {
			redirect(base_url().$cate);
		}
		// Check Cate
		$checkCate = $this->mcategory->checkCate($cate);
		if (empty($checkCate)) {
			show_404();
		}
		// Check District
		$district = $this->mdistricts->getADistrict($d_slug);
		if (empty($district)) {
			redirect(base_url().$cate);
		}
		$this->_data['title_hasParentCates']  = 'Xem thêm danh mục';
		$this->_data['category'] = $checkCate;
		$this->_data['hasParentCates'] = $this->mcategory->hasParent($checkCate->id,$checkCate->parent_id);
        $condition ='';
		if ($checkCate->parent_id == 0)
		{
			$get_cate_child = $this->db->select('id')
									   ->where('parent_id',$checkCate->id)
									   ->get('categories')
									   ->result();
			if (!empty($get_cate_child)) {
				foreach ($get_cate_child as $k => $item) {
					$condition[$k] = $item->id;
				}
				$condition[] = $checkCate->id;
			}else{
				$condition = $checkCate->id;
			}
		}else{
			$condition = $checkCate->id;
		}
		$provinces = $this->mprovinces->getProvinceSlug($p_slug);
		if (empty($provinces)) {
			redirect(base_url().$cate);
		}
		//
		$where = '';
		$ward = isset($_GET['ward'])?(int)$_GET['ward']:'0';
		$street = isset($_GET['street']) ? (int)$_GET['street'] : '0';
		$direct = isset($_GET['direct']) ? (int)$_GET['direct'] : '0';
		$price = isset($_GET['price']) ? (int)$_GET['price'] : '0';
		$area  = isset($_GET['area']) ? (int)$_GET['area'] : '0';
		$unit  = isset($_GET['unit']) ? (int)$_GET['unit'] : '0';
		$URI = "?ward=$ward&street=$street";
		if ($ward!= 0)
			$where .= ' AND ward_id='.$ward;
		if ($street != 0)
			$where .= ' AND street_id='.$street;
		if (isset($_GET['direct'])) {
			$URI .= "&direct=$direct&price=$price&area=$area&unit=$unit";
			if ($direct != 0)
			$where .= ' AND home_direction='.$direct;
			if ($price != 0)
				$where .= ' AND price ='.$price;
			if ($area != 0)
				$where.= ' AND area ='.$area;
			if ($unit != 0)
				$where .= ' AND price_type ='.$unit;
		}
		//
		$this->_data['province'] = $provinces;
		$this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($district->province_id);
		$this->_data['meta_title'] = $checkCate->title .' '.$district->name ;
		$this->_data['meta_description'] = $checkCate->title .' '.$district->name.', '.unicode2($checkCate->title .' '.$district->name).','.json_decode($checkCate->params)->meta_description;
		$this->_data['meta_keywords'] = str_replace(' ',',', $checkCate->title .' '.$district->name.','.unicode2($checkCate->title .' '.$district->name));
		$this->_data['meta_image'] = !empty($checkCate->image) ? base_url().'uploads/category/'.$checkCate->image : LOGOSITE;
        $this->_data['category'] = $checkCate;
        if(isset($_GET['p']) && !empty($_GET['p']))
			$page= (int) $_GET['p'];   
		else
			$page= 0;
		// data
		$this->load->library('pagination');
		$config['base_url'] = base_url().$cate.'/'.$p_slug .'/'.$d_slug.'.htm'.$URI;
		$config['total_rows'] = $this->realestate_model->countRealestateByDistrictId($condition,$district->district_id,$where);
		$config['per_page'] = REALESTATE_RECORD_PER_PAGE;
		$config['uri_segment'] = 5;
		$config['num_links'] = REALESTATE_PAGE_PER_SEGMENT;
		$this->_config_pagination();
		$this->pagination->initialize($config);
		$this->_data['realestates'] = $this->realestate_model->getRealestateByDistrictId($condition,$district->district_id,$config['per_page'],$page,$where);
		$this->_data['link'] = $this->pagination->create_links();
		$this->_data['temp'] = 'realestates/districts';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
	}
    public function showRealestateByProject($cate, $project_slug, $project_id,$page = 0)
    {
        if (!isset($project_id) || !is_numeric($project_id)) {
			redirect(base_url().$cate);
		}
		$checkCate = $this->mcategory->checkCate($cate);
		if (empty($checkCate)){
			redirect(base_url());
		}
		$projects = $this->mrealestate_project->getProject(toInternalId($project_id));
		if (empty($projects)) {
			redirect(base_url().$cate);
		}
		$this->_data['h1_title'] = $checkCate->title .' '.$projects->project_name .' tại '.$projects->pre. ' ' .$projects->name;
		$this->_data['meta_title'] = $checkCate->title .' '.$projects->project_name .', '.$projects->pre. ' ' .$projects->name . ' | '.$checkCate->title .' '.$projects->project_name .' tại '.$projects->pre. ' ' .$projects->name;
		$this->_data['meta_description'] = $checkCate->title .' tại '.$projects->pre. ' ' .$projects->project_name.', '.unicode2($checkCate->title .' tại '.$projects->pre. ' ' .$projects->name).','.json_decode($checkCate->params)->meta_description;
		$this->_data['meta_keywords']    = str_replace(' ',',', $checkCate->title .' '.$projects->name.','.unicode2($checkCate->title .' '.$projects->name));
		if (!empty($checkCate->image))
		{
			$this->_data['meta_image'] = base_url().'uploads/category/'.$checkCate->image;
		}else{
			$this->_data['meta_image'] = LOGOSITE;
		}
		// Get Rao vặt theo projects
		$this->load->library('pagination');
		$config['base_url'] 	   = base_url().$cate.'/'.$project_slug .'-dn'.$project_id.'/trang';
		$config['total_rows'] 	   = $this->realestate_model->countGetRealestateByProject($checkCate->id,$projects->project_id);
		$config['per_page'] 	   = REALESTATE_RECORD_PER_PAGE;
		$config['uri_segment'] 	   = 4;
		$config['num_links'] 	   = REALESTATE_PAGE_PER_SEGMENT;
		$this->_config_pagination();
		$this->pagination->initialize($config);
		$this->_data['realestates'] = $this->realestate_model->getRealestateByProject($checkCate->id,$projects->project_id,$config['per_page'],$page);
		//$this->uri->segment(5) != NULL ? $page = $this->uri->segment(5) : $page = 0;
		$this->_data['link'] = $this->pagination->create_links();
		$this->_data['temp'] = 'realestates/project';
		$this->load->view($this->_data['modules'].'/template', $this->_data);
    }
	// Config Pagination
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
}

/* End of file Realestate.php */
/* Location: ./application/modules/default/controllers/Realestate.php */