<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends AdminController {
	public function __construct()
	{
		parent::__construct();
		require_once('simple_html_dom.php');
		$this->load->helper(['unicode','menu']);
		$this->load->model(['mcategory','marticles']);
	}
	public function index()
	{
		$this->_data['title'] = 'Công cụ';
		$this->_data['temp']  = 'tools/index';
		$this->_data['category'] = $this->mcategory->get_all_categories('article');
		$item = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('link', 'link', 'trim|required');
		$config_page = $this->config_page();
		if ($this->form_validation->run() == TRUE)
		{
			$item = [
				'public'	  => $this->input->post('public'),
				'category_id' => $this->input->post('category_id'),
				'link'		  => $this->input->post('link')
			];
			$link = $this->input->post('link');
			$html = new simple_html_dom(); 
			$html = file_get_html($link);
			// Config
			$loai_bao = $this->input->post('loai_bao');
			$title_pattern       = $config_page[$loai_bao]['title_pattern'] ;
			$description_pattern = $config_page[$loai_bao]['description_pattern'] ;
			$image_thumb_pattern = $config_page[$loai_bao]['image_thumb_pattern'];
			$short_intro_pattern = $config_page[$loai_bao]['short_intro_pattern'] ;
			$tag_pattern = $config_page[$loai_bao]['tag_pattern'];
			//Begin
			/**
			 * TITLE
			 */
			foreach($html->find($title_pattern) as $element){
				$item['title'] = trim($element->plaintext);
			}
			/**
			 * summary
			 */
			foreach($html->find($short_intro_pattern) as $element){
				$item['summary'] = trim($element->plaintext);
			}
			/**
			 * image
			 */
			foreach ($html->find($image_thumb_pattern) as $element)
				$item['image'] = $element->content;
			/**
			 * description
			 */
			foreach($html->find($description_pattern) as $element){
			    $element->last_child()->outertext = '';
				$item['description'] = preg_replace('#<div class="news-tag">(.*?)</div>#', ' ', $element->innertext);
				// Lấy toàn bộ phần html
				if(isset($item['description']) and $item['description']){
					$item['description'] = $this->replace_img_src($item['title'], $this->set_path_to_upload(), $item['description']);
				}
			}
            $tag = [];
			foreach ($html->find($tag_pattern) as $element){
				array_push($tag, $element->plaintext);
			}
            $item['tags'] = $tag;
			$item['thumb'] = $this->getSaveThumbnail($item['title'],$item['image'],'./uploads/articles/',0);
			$this->session->set_flashdata('success', 'Thêm mới thành công !');
		}
		$this->_data['data'] = $item;
		$this->saveArticle($item);
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
	 * [saveArticle description]
	 * 
	 * @param  [array] $data
	 * @return [type]       [description]
	 */
	protected function saveArticle($data)
	{
		if (!empty($data)) {
			$params  = [
				'meta_description' => !empty($data['summary']) ? $data['summary'] : ''
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
				'summary'	  => !empty($data['summary']) ? $data['summary'] : '',
				'category_id' => $data['category_id'],
				'content'     => preg_replace('#<a.*?>.*?</a>#i', '', $data['description']),
				'source_link' => $data['link'],
				'created_at'  => date('Y-m-d H:i:s'),
				'updated_at'  => date('Y-m-d H:i:s'),
				'created_by'  => $this->_data['user_id'],
				'updated_by'  => $this->_data['user_id']
			];
			$articleID = $this->marticles->insert($insert);
			$config = [
				'taggable_id' => $articleID,
				'taggable_type' => 'articles'
			];
			$this->load->library('tagged',$config);
			if (!empty($data['tags'])) {
				$this->tagged->tag(implode(',', $data['tags']));
			}
		}
	}
	/**
	 * [set_path_to_upload description]
	 */
	public function set_path_to_upload()
	{
		$folderYeah  = date('Y');
		$folderMonth = date('m');
		$folderDay   = date('d');
		$pathUpload  = './uploads/properties';
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
	public function config_page()
	{
		$config_page = [
			'vnexpress' => [
				'title_pattern' 	  => 'div[class=title_news] h1',
				'description_pattern' => 'div[class=fck_detail]',
				'image_thumb_pattern' => 'meta[property=og:image]',
				'short_intro_pattern' => 'div[class=short_intro]',
				'tag_pattern' 		  => 'a[class=tag_item]',
			],
			'dantri'		=> [
				'title_pattern' 	  => 'div[id=ctl00_IDContent_ctl00_divContent] h1',
				'description_pattern' => 'div[class=detail-content]',
				'image_thumb_pattern' => 'meta[property=og:image]',
				'short_intro_pattern' => 'h2[class=sapo]',
				'tag_pattern' 		  => 'span[class=news-tags-item] a',
			],
			'thanhnien'     => [
				'title_pattern' 	  => 'h1[class=main-title]',
				'description_pattern' => 'div[id=abody]',
				'image_thumb_pattern' => 'meta[property=og:image]',
				'short_intro_pattern' => 'div[class=sapo]',
				'tag_pattern' 		  => 'ul[class=tags] li a',
			],
            'cafef'     => [
				'title_pattern' 	  => 'div[class=newscontent_top] h1',
				'description_pattern' => 'div[class=newsbody]',
				'image_thumb_pattern' => 'meta[property=og:image]',
				'short_intro_pattern' => 'h2[class=sapo]',
				'tag_pattern' 		  => 'div[class=tags] li a',
			],
            'cafeland'     => [
				'title_pattern' 	  => 'h1[class=title-detail]',
				'description_pattern' => 'div[class=entry]',
				'image_thumb_pattern' => 'meta[property=og:image]',
				'short_intro_pattern' => 'div[class=head-detail] div.short-text',
				'tag_pattern' 		  => 'h4[id=tags] a',
			],
		];
		return $config_page;
	}
}

/* End of file tools.php */
/* Location: ./application/modules/admin/controllers/tools.php */