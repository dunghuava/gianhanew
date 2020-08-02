<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends DefaultController {

	public function __construct()
	{
		parent::__construct();
	}
	public function sitemap()
    {
		$result = [];
		// Categories
		foreach ($this->get_categories() as $k => $categorie) {
			$result['categories'][$k]['link']  = base_url().$categorie->title_alias;
		}
        foreach ($this->get_tag() as $k => $tag){
            $result['tags'][$k]['link']  = base_url().'tag/'.$tag->slug;
        }
        foreach ($this->get_article() as $k => $article) {
            $result['articles'][$k]['link']  = base_url().$article->slug_cate.'/'.$article->title_alias.'.html';
        }
        foreach ($this->getProvinces() as $k => $cate_province) {
            $result['cate_province'][$cate_province->province_id] = base_url().$cate_province->title_alias.'/'.$cate_province->slug_name.'-tp'.toPublicID($cate_province->province_id).'.htm';
        }
        foreach ($this->getRealestates() as $k => $realestate) {
            $result['realestates'][$k] = base_url().$realestate->slug_cate.'/'.$realestate->title_alias.'-'.$realestate->id;
        }
        foreach ($this->getDistricts() as $k => $district) {
            $result['districts'][$district->district_id] = base_url().$district->title_alias.'/'.$district->p_alias.'/'.$district->d_alias.'.htm';
        }
        
        $this->_data['data'] = $result;
        header("Content-Type: text/xml;charset=utf-8");
        $this->load->view($this->_data['modules']."/sitemap",$this->_data);
    }
    public function get_categories()
    {
    	return $this->db->select('id,title,title_alias')
    					->order_by('created_at','asc')
    					->get('categories')->result();
    }
    public function get_article(){
        return $this->db->select('articles.id,articles.title, articles.title_alias, articles.params, articles.created_at, articles.image, categories.title_alias as slug_cate')
                        ->join('categories','categories.id = articles.category_id')
                        ->order_by('articles.created_at','asc')
                        ->get('articles')->result();
    }
    public function get_tag()
    {
        return $this->db->select('name,slug')->get('tagging_tags')->result();
    }
    public function getProvinces()
    {
        return $this->db->select('provinces.slug_name, provinces.province_id, categories.title_alias')
                          ->join('categories' , 'categories.id = realestates.category_id')
                          ->join('provinces', 'provinces.province_id = realestates.province_id')
                          ->where('realestates.public',1)
                          ->get('realestates')
                          ->result();
    }
    public function getRealestates()
    {
        return $this->db->select('realestates.id,categories.title_alias as slug_cate,realestates.title_alias')
                          ->join('categories' , 'categories.id = realestates.category_id')
                          ->where('realestates.public',1)
                          ->get('realestates')
                          ->result();
    }
    public function getDistricts()
    {
        return $this->db->select('districts.slug_name as d_alias, provinces.slug_name as p_alias, categories.title_alias,realestates.district_id')
                          ->join('categories' , 'categories.id = realestates.category_id')
                          ->join('provinces', 'provinces.province_id = realestates.province_id')
                          ->join('districts', 'districts.district_id = realestates.district_id')
                          ->where('realestates.public',1)
                          ->get('realestates')
                          ->result();
    }
}

/* End of file seo.php */
/* Location: ./application/modules/default/controllers/seo.php */