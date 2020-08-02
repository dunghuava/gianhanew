<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends DefaultController {
	public function __construct()
	{
		parent::__construct();
		require_once('simple_html_dom.php');
	}
	public function index()
	{
		$data = '<h2>Testing Cronjob '.date('H:i:s').'</h2>
		<hr>
		<p>Tài Khoản: <strong>'.$this->input->post('username').'</strong></p>
		<p>Mật khẩu : <strong>'.$this->input->post('password').'</strong></p>
		<hr>
		<p><small>Ngay bây giờ anh/chị hãy đăng tin sản phẩm của mình. Chúng tôi sẽ marketing hiệu quả cho sản phẩm của anh/chị.Nếu thư này có làm phiền anh/chị chúng tôi thành thật xin lỗi. Chúc anh/chị một ngày vui vẻ !</p></small>';

		$mail = new Mail();
		$mail->setMailBody($data);
		$mail->sendMail('Đăng ký tài khoản thành công !', 'quochieuhcm@gmail.com');
	}
	public function test(){
		$link = 'http://cafef.vn/bat-dong-san/thi-truong.chn';
		$item = array();
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux i686; pt-BR; rv:1.9.2.18) Gecko/20110628 Ubuntu/10.04 (lucid) Firefox/3.6.18' );
		curl_setopt( $ch, CURLOPT_URL, $link );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		$html = new simple_html_dom(); 
		$html->load($result);
		foreach ($html->find('div[class=list_left_cate] ul[class=list]') as $product){
			foreach ($product->find('h3 a') as $k => $title){
				$item[$k]= 'http://cafef.vn'.$title->href;
			}
		}
		return $item;
	}

	public function single()
	{
		$item  = $this->test();
		if (!empty($item)){
			foreach ($item as $key => $value) {
				$this->getDe($value);
				sleep(3);
			}
		}
		$data = '<h2>Cronjob complete at: '.date('d-m-Y H:i:s').'</h2>';
		$mail = new Mail();
		$mail->setMailBody($data);
		$mail->sendMail('Cronjob News Auto !', 'quochieuhcm@gmail.com');
	}

	public function getDe($link)
	{
		$item = array();
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux i686; pt-BR; rv:1.9.2.18) Gecko/20110628 Ubuntu/10.04 (lucid) Firefox/3.6.18' );
		curl_setopt( $ch, CURLOPT_URL, $link );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		$html = new simple_html_dom(); 
		$html->load($result);
		foreach($html->find('div[class=newscontent_top] h1') as $element){
			$item['title'] = trim($element->plaintext);
		}
		foreach($html->find('div[class=newscontent_right] h2[class=sapo]') as $element){
			$item['summary'] = trim($element->plaintext);
		}
		/**
		* image
		*/
		foreach ($html->find('meta[property=og:image]') as $element)
			$item['image'] = $element->content;
		foreach($html->find('div[class=newscontent_right] div[class=newsbody]') as $element){
			$element->last_child()->outertext = '';
			$item['description'] = preg_replace('#<div class="news-tag">(.*?)</div>#', ' ', $element->innertext);
				// Lấy toàn bộ phần html
			if(isset($item['description']) and $item['description']){
				$item['description'] = $this->replace_img_src($item['title'],$this->set_path_to_upload(), $item['description']);
			}
		}
		$tags = [];
		foreach ($html->find('div[class=tags] ul') as $t){
			foreach ($t->find('li a') as $k => $tag){
				array_push($tags, $tag->innertext);
			}
		}
		$item['tags']  = $tags;
		$item['thumb'] = $this->getSaveThumbnail($item['title'],$item['image'],'./uploads/articles/',0);
		$item['link']  = $link;
		$this->saveArticle($item);
	}
	protected function saveArticle($data)
	{
		$msg = '';
		$this->load->model('marticles');
		if (!empty($data)){
			if (!$this->marticles->checksourcelink($data['link'])) {
				$params  = [
					'meta_title'       => $data['title'],
					'meta_description' => $data['summary']
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
					'public'	  => 1,
					'summary'	  => $data['summary'],
					'category_id' => 36,
					'content'     => preg_replace('#<a.*?>.*?</a>#i', '', $data['description']),
					'source_link' => $data['link'],
					'created_at'  => date('Y-m-d H:i:s'),
					'updated_at'  => date('Y-m-d H:i:s'),
					'created_by'  => 1,
					'updated_by'  => 1
				];
				$articleID = $this->marticles->insert($insert);
				if ($articleID != 0) {
					$config = [
					'taggable_id'   => $articleID,
					'taggable_type' => 'articles'
					];
					$this->load->library('tagged',$config);
					if (!empty($data['tags'])) {
						$this->tagged->tag(implode(',', $data['tags']));
					}
				}
			}else{
				
			}
		}
	}
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
				$src = make_unicode($title).'-p-'.$i.'.'.pathinfo($link_image,PATHINFO_EXTENSION);
				$fp  = fopen($pathSave.$src, "w");
			}
			fwrite($fp, $content);
			fclose($fp);
		}
		return $src;
	}
	public function set_path_to_upload()
	{
		$folderYeah  = date('Y');
		$folderMonth = date('m');
		$folderDay   = date('d');
		$pathUpload  = './uploads/articles/';
		/*if (!is_dir($pathUpload.'/' . $folderYeah)) {
			mkdir($pathUpload.'/' . $folderYeah, 0777, TRUE);
		}
		if (!is_dir($pathUpload.'/' . $folderYeah.'/'.$folderMonth)) {
			mkdir($pathUpload.'/' . $folderYeah.'/'.$folderMonth, 0777, TRUE);
		}
		if (!is_dir($pathUpload.'/' . $folderYeah.'/'.$folderMonth.'/'.$folderDay)) {
			mkdir($pathUpload.'/' . $folderYeah.'/'.$folderMonth.'/'.$folderDay, 0777, TRUE);
		}*/
		return $pathUpload;
	}
}
?>