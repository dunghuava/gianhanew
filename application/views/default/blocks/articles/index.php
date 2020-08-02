<?php
if (isset(json_decode($block->params)->template) && file_exists(APPPATH.'views/'.$modules.'/blocks/articles/templates/'.strtolower(json_decode($block->params)->template).'.php')) {
	$this->load->view($modules.'/blocks/articles/templates/'.strtolower(json_decode($block->params)->template),compact('block',$block),FALSE);
}else{
	$this->load->view($modules.'/blocks/articles/templates/default',compact('block',$block));
}
?>