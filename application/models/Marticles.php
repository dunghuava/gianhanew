<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Articles
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com > | 0949.133.224
* @copyright 2015
*/
class Marticles extends MY_Model
{
	public $rules = array(
		'insert' => array(
			'title' => array(
				'field'=>'title',
				'label'=>'tiêu đề',
				'rules'=>'trim|required'
			),
			'title_alias' => array(
				'field'=>'title_alias',
				'label'=>'tên bí danh',
				'rules'=>'trim|required'
			)
		),
        'update' => array(
			'title' => array(
				'field'=>'title',
				'label'=>'tiêu đề',
				'rules'=>'trim|required'
			),
			'title_alias' 	 => array(
				'field'=>'title_alias',
				'label'=>'tên bí danh',
				'rules'=>'trim|required'
			)
		)
	);
	#table_name 
	protected $table_name = 'articles';
	/**
	 * __construct
	 */
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
    public function checkUserHaveArticel($created_at)
    {
        return $this->db->where('created_by',$created_at)->get($this->table_name)->num_rows();
    }
	/**
	 *
	 * 
	 * Get All Article
	 *
	 * 
	 * @return [type] [description]
	 */
	public function get_all_articles()
	{
		$this->db->select('articles.id, articles.title, articles.image, articles.public, users.display_name, categories.title as title_cate, articles.updated_at');
		$this->db->join('users', 'users.id = articles.created_by');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->order_by('articles.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	public function get_article($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
	public function load_ajax()
	{
	 	$this->db->select('id, title');
	 	$data = $this->db->get($this->table_name)->result();
	 	$result = null;
	 	if (!empty($data))
	 	{
	 		foreach ($data as $key => $item) {
	 			$result[$key]['id'] 	= $item->id;
	 			$result[$key]['title']  = $item->title;
	 		}
	 	}
	 	return $result;
	}
	/**
	 * Frontend
	*/
	// bai viet moi nhat
	public function getLastNewByCateID($category_id=null)
	{
		$this->db->select('articles.id,articles.title, articles.title_alias, articles.image, articles.summary, articles.created_at, articles.params, categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if ($category_id != null) {
			if (is_array($category_id)) {
			$this->db->where_in('articles.category_id' , $category_id);
			}else{
				$this->db->where('articles.category_id' , $category_id);
			}
		}
		$this->db->where(['articles.public' => 1]);
		$this->db->limit(1);
		$this->db->order_by('articles.created_at', 'desc');
		return $this->db->get($this->table_name)->row();
	}
    public function moinhattiep()
    {
        $this->db->select('articles.id,articles.title, articles.title_alias, articles.image,categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->where(['articles.public' => 1]);
		$this->db->limit(2,1);
		$this->db->order_by('articles.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
    }
	// Post thumb
	public function getPostThumb($category_id = null)
	{
		$last = $this->getLastNewByCateID($category_id);
		if (!empty($last)) {
			$this->db->select('articles.id,articles.title_alias, articles.title, articles.image, categories.title_alias as slug_cate');
			$this->db->join('categories', 'categories.id = articles.category_id');
			if ($category_id != null) {
				if (is_array($category_id)) {
				$this->db->where_in('articles.category_id' , $category_id);
				}else{
					$this->db->where('articles.category_id' , $category_id);
				}
			}
			$this->db->where(['articles.public'=> 1,'articles.id !='=> $last->id]);
			$this->db->limit(3);
			$this->db->order_by('articles.created_at', 'desc');
			return $this->db->get($this->table_name)->result();
		}
		
	}
	//
	public function getListAticles($category_id,$record,$start)
	{
		$this->db->select('articles.id, articles.title, articles.params, articles.image, articles.title_alias, articles.created_at, articles.summary, categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if (is_array($category_id)) {
			$this->db->where_in('articles.category_id', $category_id);
		}else{
			$this->db->where('articles.category_id', $category_id);
		}
		$this->db->where(['articles.public' => 1]);
		$this->db->limit($record,$start);
		$this->db->order_by('articles.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	public function count_getListAticles($category_id)
	{
		$this->db->select('articles.id,articles.title,articles.image,articles.title_alias,articles.created_at,categories.title as title_cate , categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if (is_array($category_id)) {
			$this->db->where_in('articles.category_id', $category_id);
		}else{
			$this->db->where('articles.category_id', $category_id);
		}
		$this->db->where(['articles.public' => 1]);
		return $this->db->get($this->table_name)->num_rows();
	}
	/**
	 * $this->marticles->getDetail()
	 * 
	 * @param  [type] $category_id [description]
	 * @param  [type] $title_alias [description]
	 * @return [type]              [description]
	 */
	public function getDetail($category_id, $title_alias)
	{
		$this->db->select('articles.*,categories.title as title_cate , categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->where(['articles.public' => 1, 'articles.title_alias'=> $title_alias, 'articles.category_id' => $category_id]);
		return $this->db->get($this->table_name)->row();
	}
	public function otherGetDetail($category_id, $articelID)
	{
		$this->db->select('articles.id,articles.title, articles.title_alias, articles.image, articles.summary, articles.created_at, articles.content, categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->where(['articles.id !='=> $articelID, 'articles.category_id' => $category_id , 'articles.public' => 1]);
		$this->db->limit(6);
		$this->db->order_by('articles.created_at', 'RANDOM');
		return $this->db->get($this->table_name)->result();
	}
	public function mostViewArticle($category_id = null)
	{
		$this->db->select('articles.id,articles.title, articles.title_alias, articles.image, categories.title_alias as slug_cate');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if ($category_id != null) {
			$this->db->where('articles.category_id', $category_id);
		}
		$this->db->where(['articles.public' => 1]);
		$this->db->limit(5);
        $this->db->order_by('articles.id', 'RANDOM');
		$this->db->order_by('articles.hits', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	/**
	 * Search
	 */
	function get_data_search($record,$start,$term)
	{
		$q = $this->db->query("SELECT articles.image,articles.title,articles.created_at,articles.params,articles.title_alias, categories.path,categories.title_alias as slug_cate FROM articles INNER JOIN categories ON categories.id = articles.category_id WHERE articles.title LIKE '%$term%' OR articles.params LIKE '%$term%' LIMIT $start,$record")
					  ->result();
		return $q;
	}
	function count_get_data_search($term)
	{
		$q = $this->db->query("SELECT * FROM articles WHERE title LIKE '%$term%' OR params LIKE '%$term%'")->num_rows();
		return $q;
	}
    public function checkUserHaveArticle($created_by)
    {
        return $this->db->where('created_by',$created_by)->get('articles')->num_rows();
    }

    public function checksourcelink($link)
    {
    	$this->db->where('source_link', $link);
    	$query = $this->db->get($this->table_name);
    	if ($query->num_rows() > 0) {
    		return TRUE;
    	}else{
    		return FALSE;
    	}
    }
    public function singleItem($params)
    {
    	if (!is_object($params)) {
			return false;
		}
		$this->db->select('articles.id, articles.title, articles.title_alias, articles.image, articles.updated_at, categories.title_alias as cate_slug');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->where(['articles.public' => 1]);
		$this->db->where_in('articles.category_id', $this->mcategory->getCategoriesByParentId($params->category_id));
		if ($params->feature_only != 0)
			$this->db->where('articles.featured',1);
		$this->db->order_by('articles.'.$params->orderBy, $params->direction);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return false;
    }
    /**
	 * $this->marticles->loadBlocks($params)
	 * 
	 * @param  [int] $category_id       [ Categories ID]
	 * @param  [int] $include_sub_cates [ Include sub categorie]
	 * @param  [int] $feature_only      [ Feature]
	 * @param  [int] $orderBy           [ description]
	 * @param  [string] $amount_of_data [ description]
	 * @param  [int] $direction         [ description]
	 * @return [object]                 [ description]
	 */
	public function loadBlocks($params,$single_item = NULL)
	{
		if (!is_object($params)) {
			return false;
		}
		$this->db->select('articles.title, articles.title_alias, articles.image, articles.updated_at, categories.title_alias as cate_slug');
		$this->db->join('categories', 'categories.id = articles.category_id');
		$this->db->where(['articles.public' => 1]);
		if ($single_item != NULL && is_numeric($single_item)) {
			$this->db->where('articles.id !=', $single_item->id);
		}
		$this->db->where_in('articles.category_id', $this->mcategory->getCategoriesByParentId($params->category_id));
		if ($params->feature_only != 0)
			$this->db->where('articles.featured',1);
		$this->db->order_by('articles.'.$params->orderBy, $params->direction);
		$this->db->limit($params->amount_of_data);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
}