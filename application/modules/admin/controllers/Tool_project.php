<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tool_project extends AdminController
{
    public function __construct()
	{
		parent::__construct();
		require_once('simple_html_dom.php');
		$this->load->helper(['unicode','menu']);
		$this->load->model(['mcategory','mprojects']);
	}
    public function index()
    {
        $this->_data['title'] = 'Công cụ dự ';
		$this->_data['temp']  = 'tools/project';
        $this->_data['category'] = $this->mcategory->get_all_categories('project');
		$item = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('link', 'link', 'trim|required');
		if ($this->form_validation->run() == TRUE)
        {
            $item = [
				'public'	  => $this->input->post('public'),
                'featured'	  => $this->input->post('featured'),
				'category_id' => $this->input->post('category_id'),
				'link'		  => $this->input->post('link')
			];
    	    $html = new simple_html_dom(); 
    		$html = @file_get_html($this->input->post('link'));
            
            foreach($html->find('div[class=head-detail] h1') as $element){
    				$item['title'] = trim($element->plaintext);
    		}
            /**
    	    * summary
    		*/
    		foreach($html->find('div[class=head-detail] .short-text') as $element){
    		   $item['summary'] = trim($element->plaintext);
    		}
            foreach($html->find('div[class=entry].noidungtin-content') as $element){
    			    $element->first_child()->outertext = '';
    				$item['description'] = trim($element->innertext);
    				// Lấy toàn bộ phần html
                    if(isset($item['description']) and $item['description']){
    					$item['description'] = $this->replace_img_src($item['title'], $this->set_path_to_upload(), $item['description']);
    				}
                    $element->last_child()->outertext = '';
    		}
            foreach($html->find('select[id=tin_tinh]') as $province_id) { 
                $options = $province_id->find('option[selected]'); 
                foreach($options as $province_id) { 
                    $item['province_id'] = trim(str_replace('TP.','',$province_id->plaintext)); 
                } 
            }
            foreach($html->find('select[id=tin_huyen]') as $district_id){ 
                $options = $district_id->find('option[selected]'); 
                foreach($options as $district_id) { 
                    $item['district_id'] = trim($district_id->plaintext);
                } 
            }
            $table = str_get_html($item['description']);
            $address = trim(strip_tags($table->find('table tr td',2)->innertext));
            if(!empty($address))
            {
                $address_array = explode(':',$address);
                if(sizeof($address_array) > 1)
                {
                    $item['address'] = $address_array[1];
                    $url  = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address_array[1]) . '&sensor=true';
                    $json = @file_get_contents($url);
                    $position = json_decode($json);
                    if ($position->status == "OK"){
                        $item['lat'] = $position->results[0]->geometry->location->lat;
                        $item['lng'] = $position->results[0]->geometry->location->lng;
                    }
                    
                }else{
                    $url  = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true';
                    $json = @file_get_contents($url);
                    $position = json_decode($json);
                    if ($position->status == "OK"){
                        $item['lat'] = $position->results[0]->geometry->location->lat;
                        $item['lng'] = $position->results[0]->geometry->location->lng;
                    }
                    $item['address'] = $address;
                }
            }
            
            $tag = [];
    		foreach ($html->find('h4[id=tags] a') as $element){
                array_push($tag, $element->plaintext);
    		}
            $item['tags'] = $tag;
            foreach ($html->find('meta[property=og:image]') as $element)
    				$item['image'] = $element->content;
            $item['thumb'] = $this->getSaveThumbnail($item['title'],$item['image'],'./uploads/projects/',0);
        }
        $this->_data['data'] = $item;
		$this->saveProject($item);
		$this->load->view($this->_data['modules'].'/dashboard',$this->_data);
    }
    /**
	 *
	 * 
	 * [replace_img_src description]
	 *
	 * 
	 * @param  [type] $title    [description]
	 * @param  [type] $pathSave [description]
	 * @param  [type] $img_tag  [description]
	 * @return [type]           [description]
	 */
	public function replace_img_src($title, $pathSave, $img_tag)
	{
	    $doc = new DOMDocument();
	    @$doc->loadHTML(mb_convert_encoding($img_tag, 'HTML-ENTITIES', 'UTF-8'));
	    $tags = $doc->getElementsByTagName('img');
	    // base_url()
	    $base_url = base_url().$this->set_path_to_upload();
	    foreach($tags as $i => $tag){
	        $old_src = $tag->getAttribute('src');
            $new_src_url = $base_url.$this->getSaveThumbnail($title, $old_src, $pathSave,$i);
	        $tag->setAttribute('src', $new_src_url);
	    }
	    return $doc->saveHTML();
	}
    /**
	 *
	 * 
	 * [getSaveThumbnail lay hinh anh thumbnail]
	 *
	 * 
	 * @param  [type] $title      [description]
	 * @param  [type] $link_image [description]
	 * @param  [type] $pathSave   [description]
	 * @return [type]             [description]
	 */
	protected function getSaveThumbnail($title,$link_image, $pathSave, $i)
	{
		if (isset($link_image) && !empty($link_image)){
			$src = '';
			$content = file_get_contents($link_image);
			if (!file_exists($pathSave.make_unicode($title).'.'.pathinfo($link_image,PATHINFO_EXTENSION)))
			{
				$src = make_unicode($title).'.'.pathinfo($link_image,PATHINFO_EXTENSION);
				$fp = fopen($pathSave.$src, "w");
			}else{
				$src = make_unicode($title).'-anh-'.$i.'.'.pathinfo($link_image,PATHINFO_EXTENSION);
				$fp  = fopen($pathSave.$src, "w");
			}
			fwrite($fp, $content);
			fclose($fp);
		}
		return $src;
	}
    /**
     * Lưu dự án vào 
     * 
     * 
     */
    public function saveProject($data)
    {
        if (!empty($data)){
			$params  = [
                'address' => $data['address'],
                'website' => '',
                'email' => '',
                'phone'   => '',
				'meta_description' => $data['summary'],
			];
			if (isset($data['tags']) && !empty($data['tags'])){
				$params['meta_keywords'] = implode(',', $data['tags']);
			}else{
			    $params['meta_keywords'] = $data['title'];
			}
			$insert = [
				'title' 	  => $data['title'],
				'title_alias' => make_unicode($data['title']),
				'image'		  => $data['thumb'],
				'params'      => json_encode($params,JSON_UNESCAPED_UNICODE),
				'public'	  => $data['public'],
				'summary'	  => $data['summary'],
				'category_id' => $data['category_id'],
				'content'     => $data['description'],
                'status'      => 1,
				'featured' => $data['featured'],
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
            if(isset($data['province_id']) && !empty($data['province_id']))
            {
                $province_id = $this->returnProvinceID($data['province_id']);
                $insert['province_id'] = !empty($province_id) ? $province_id : '1';
            }
            if(isset($data['district_id']) && !empty($data['district_id']))
            {
                $district_id = $this->returnDistrictID($data['district_id']);
                $insert['district_id'] = !empty($district_id) ? $district_id : '1';
            }
            if(isset($data['lat']) && isset($data['lng']))
            {
                $insert['lat'] = $data['lat'];
                $insert['lng'] = $data['lng'];
            }
			$projectsID = $this->mprojects->insert($insert);
			$config = [
				'taggable_id'   => $projectsID,
				'taggable_type' => 'projects'
			];
			$this->load->library('tagged',$config);
			if (!empty($data['tags'])) {
				$this->tagged->tag(implode(',', $data['tags']));
			}
		}
    }
    public function set_path_to_upload()
	{
		$folderYeah  = date('Y');
		$folderMonth = date('m');
		$folderDay   = date('d');
		$pathUpload  = './uploads/projects/properties';
		if (!is_dir($pathUpload.'/' . $folderYeah)) {
			mkdir($pathUpload.'/' . $folderYeah, 0777, TRUE);
		}
		if (!is_dir($pathUpload.'/' . $folderYeah.'/'.$folderMonth)) {
			mkdir($pathUpload.'/' . $folderYeah.'/'.$folderMonth, 0777, TRUE);
		}
		if (!is_dir($pathUpload.'/' . $folderYeah.'/'.$folderMonth.'/'.$folderDay)) {
			mkdir($pathUpload.'/' . $folderYeah.'/'.$folderMonth.'/'.$folderDay, 0777, TRUE);
		}
		return $pathUpload.'/' . $folderYeah.'/'.$folderMonth.'/'.$folderDay.'/';
	}
    public function returnDistrictID($district)
    {
        $this->load->model('mdistricts');
        $data = $this->mdistricts->searchLike($district);
        $kq = '';
        if(!empty($data)){
            $kq = $data->district_id;
        }
        return $kq;
    }
    public function returnProvinceID($province)
    {
        $this->load->model('mprovinces');
        $data = $this->mprovinces->searchLike($province);
        $kq = '';
        if(!empty($data)){
            $kq = $data->province_id;
        }
        return $kq;
    }
}