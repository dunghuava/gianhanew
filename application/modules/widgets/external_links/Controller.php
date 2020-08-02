<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class External_links_widget extends MY_Widget
{
    function index(){
    	$this->load->model('mexternal_links');
        $this->load->view('view',array('external_links' => $this->mexternal_links->getExternalLinks()));
    }
}