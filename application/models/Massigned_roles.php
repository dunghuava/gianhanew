<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model assigned_roles
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com > | 0949.133.224
* @copyright 2015
*/
class Massigned_roles extends MY_Model
{
	protected $table_name = "assigned_roles";
	public function __construct()
	{
		parent::__construct();
	}
}