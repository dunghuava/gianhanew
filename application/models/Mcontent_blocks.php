<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcontent_blocks extends MY_Model 
{
	protected $table_name = 'content_blocks';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function getContentBlocks()
	{
		$this->db->select('content_blocks.id, content_blocks.title, content_blocks.public, content_blocks.position, content_blocks.updated_at, users.display_name, content_block_types.title as type_title');
		$this->db->join('content_block_types', 'content_block_types.id = content_blocks.type_id');
		$this->db->join('users', 'users.id = content_blocks.created_by');
		return $this->db->get($this->table_name)->result();
	}
	public function getContentBlockById($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
	/**
	 * FRONTEND
	 */
	public function getContentBlockByPosition($position)
	{
		$this->db->where('public', 1);
		$this->db->where('position',$position);
		$data = $this->db->get('content_blocks')->row();
		$result = [];
		if (!empty($data)){
			switch ($data->type_id) {
				case '1':
					$checkCate = $this->db->where(array('id'=>json_decode($data->params)->category_id,'component'=>'article'))
										  ->get('categories')
										  ->row();
					if (json_decode($data->params)->show_title == 1) {
						$result['title']   = $data->title;
					}else{
						$result['title']   = $checkCate->title;
					}
					$result['alias'] = $checkCate->title_alias;					
					$list = $this->listArticleByCateId($checkCate->id,json_decode($data->params)->orderBy,json_decode($data->params)->direction,json_decode($data->params)->amount_of_data);
					$result['data'] = $list;
					break;
				default:
					# code...
					break;
			}
		}
		return $result;
	}
	// TypeId: 1
	public function listArticleByCateId($category_id,$orderBy,$direction,$amount_of_data=null)
	{
		$result = [];
		$this->db->select('articles.id,articles.params, articles.image, articles.title, articles.title_alias, articles.summary, categories.title_alias as cate_slug, articles.created_at');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if (is_array($category_id))
			$this->db->where_in('articles.category_id', $category_id);
		else
			$this->db->where('articles.category_id', $category_id);
		
		$this->db->limit(1);
		$this->db->order_by('articles.'.$orderBy, $direction);
		if ($amount_of_data != null)
			$this->db->limit($amount_of_data);
		$data = $this->db->get('articles')->row();
		if (!empty($data)) {
			$result['last']['title'] =  $data->title;
			$result['last']['title_alias'] = base_url().$data->cate_slug. '/'. $data->title_alias.'.html';
			$result['last']['image']   = base_url().'/resizer/timthumb.php?src=uploads/articles/'. $data->image;
			$result['last']['summary'] = (!empty($data->summary)) ? $data->summary : json_decode($data->params)->meta_description;
            $result['last']['date'] = $data->created_at;
		}
		$this->db->select('articles.category_id, articles.id, articles.image, articles.title, articles.title_alias, articles.summary, categories.title_alias as cate_slug,  articles.created_at');
		$this->db->join('categories', 'categories.id = articles.category_id');
		if (is_array($category_id))
			$this->db->where_in('articles.category_id', $category_id);
		else
			$this->db->where('articles.category_id', $category_id);

		if (!empty($data)) 
			$this->db->where('articles.id !=', $data->id);

		$this->db->order_by('articles.'.$orderBy, $direction);
		if ($amount_of_data != null)
			$this->db->limit($amount_of_data - 1);
		$data2 = $this->db->get('articles')->result();
		if (!empty($data2)) {
			$result['last_child'] = $data2;
		}
		return $result;
	}
	/*** FRONTEND*/
	/**
	 * $this->mcontent_blocks->countBlocks($positions)
	 * 
	 * @param  [type] $positions [description]
	 * @return [type]            [description]
	 */
	public function countBlocks($positions)
	{
        if (is_array($positions)) {
            $totalCount = 0;
            foreach ($positions as $position) {
                $totalCount += $this->db->where(['public'=>1, 'position' => $position])->get($this->table_name)->num_rows();
            }
            return $totalCount;
        }
        return $this->db->where(['public'=>1, 'position' => $positions])->get($this->table_name)->num_rows();
    }
	/**
     * $this->mcontent_blocks->loadBlocks($position)
     * 
     * @param mixed $position
     * @return
     */
    public function loadBlocks($position)
    {
    	$this->db->select('content_blocks.*, content_block_types.action');
    	$this->db->join('content_block_types', 'content_block_types.id = content_blocks.type_id');
    	$this->db->where(['content_blocks.public' => 1,'content_blocks.position' => $position]);
    	return $this->db->get($this->table_name)->result();
    }
}
/* End of file mcontent_blocks.php */
/* Location: ./application/models/mcontent_blocks.php */