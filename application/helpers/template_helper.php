<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Helper List Template
	*/
if (!function_exists('get_template_page')) {
	function get_template_page()
	{
		return array(
			'templates/bds'			=> 'Sàn giao dịch',
			'templates/tmp_finance' => 'Bảng tính tài chính',
			'templates/tmp_about'   => 'Giới thiệu',
			'templates/tmp_contact' => 'Liên hệ'
		);
	}
}
if (!function_exists('in_template_page')) {
	function in_template_page($template)
	{
		$templateList = get_template_page();
		return array_key_exists($template, $templateList);
	}
}
if (!function_exists('components'))
{
	function components()
	{
		return array(
			'article',
			'realestate',
			'project',
			'contact'
		);
	}
}
if (!function_exists('in_components')) {
	function in_components($component)
	{
		$componentList = components();
		return in_array($component, $componentList);
	}
}
?>