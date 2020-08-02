<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgallerys extends MY_Model
{
	protected $table_name = 'shopping_products_gallerys';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function allGallerys($product_id)
	{
		return $this->db->where('product_id', $product_id)->get($this->table_name)->result();
	}
}
/* End of file mgallerys.php */
/* Location: ./application/models/mgallerys.php */