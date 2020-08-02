<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * @author Hieu Pham - HCM
 * @copyright 2014
 */
/* load the MX_Controller class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{
	public $_data;
	function __construct()
	{
		parent::__construct();
	}
}
?>