<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Mtagging_tags extends MY_Model
{
	protected $table_name = 'tagging_tags';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	/**
	 *
	 * 
	 * [checkTag description]
	 *
	 * 
	 * @param  [type] $tag [description]
	 * @return [type]      [description]
	 */
	public function checkTag($tag)
	{
		$data = $this->db->where('name', $tag)->get($this->table_name);
		if ($data->num_rows() > 0) {
			return $data->row();
		}
	}
}