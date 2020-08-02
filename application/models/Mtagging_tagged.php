<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Mtagging_tagged extends MY_Model
{
	protected $table_name = 'tagging_tagged';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	/**
	 *
	 * 
	 * Get tag by article id
	 *
	 * 
	 * @param  [type] $articleID [description]
	 * @return [type]            [description]
	 */
	public function get_tag_by_article($articleID,$controller)
	{
		return $this->db->select('tag_name')->where(['taggable_id'=>$articleID,'taggable_type' => $controller])->get($this->table_name)->result_array();
	}
	public function checkTagInsert($articleId,$tag,$tag_type)
	{
		return $this->db->where(array('taggable_id'=> $articleId, 'tag_name'=>$tag,'taggable_type'=>$tag_type))->get($this->table_name)->num_rows();

	}
    public function getInfoTag($tag_slug)
    {
        $this->db->select('tagging_tagged.tag_name,tagging_tagged.tag_slug,tagging_tagged.taggable_type,tagging_tags.params');
        $this->db->join('tagging_tags','tagging_tags.slug = tagging_tagged.tag_slug');
        $this->db->where('tagging_tagged.tag_slug',$tag_slug);
        return $this->db->get("tagging_tagged")->row();
    }
}