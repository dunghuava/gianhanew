<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = "default/home/index";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] 	 = 'admin/dashboard/index';
$route['login.html'] = 'auth/authentication/index';
$route['logout.html']= 'auth/authentication/logout';
$route['under-construction\.html'] = 'default/offline/index';
$route['seo/sitemap\.xml'] = "default/seo/sitemap";
// Users
$route['dang-ky.htm']   = 'default/user/register';
$route['dang-nhap.htm'] = 'default/user/login';
$route['dang-xuat.htm'] = 'default/user/sign_out';
$route['quen-mat-khau.htm'] = 'default/user/fotget_password';
$route['thanh-vien/quan-ly-tin-rao.htm'] = 'default/user/index';
$route['thanh-vien/quan-ly-tin-rao/trang'] = 'default/user/index';
$route['thanh-vien/quan-ly-tin-rao/trang/(:num)'] = 'default/user/index/$1';
$route['thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm'] = 'default/postting/create';
$route['thanh-vien/dang-tin-ban-cho-thue-nha-dat-sua(:num).htm'] = 'default/postting/update/$1';
$route['thanh-vien/doi-mat-khau.htm'] = 'default/user/change_password';
$route['thanh-vien/thay-doi-thong-tin.htm'] = 'default/user/reInfo';
$route['thanh-vien/tin-nhan.htm'] = 'default/user/inbox';
$route['handler.htm'] = 'default/handler/checkModules';
$route['getUserInfo.html'] = 'default/user/info';
// Search
$route['tim-kiem-du-an.htm'] = 'default/project/findProject';
//Postting
$route['repost.htm']  = 'default/postting/repost';
$route['destroy.htm'] = 'default/postting/destroy';
$route['tim-du-an'] = 'default/project/searchGetProject';
$route['du-an/consult'] = 'default/project/save_consult';
// End User
$route['tim-kiem\.html']   = "default/search/index";
$route['tim-kiem/trang']   = "default/search/index/";
$route['tim-kiem/trang/(:num)'] = "default/search/index/$1";
// Tag
$route['^tag/([a-zA-Z0-9-_]+)$'] = 'default/article/tags/$1';
$route['^([a-zA-Z0-9-_]+)\.html$']   = 'default/page/index/$1';
// Categories
$route['^([a-zA-Z0-9-_]+)$']  = 'default/categories/category/$1';
$route['lay-lai-mat-khau/(:any)/(:any)'] = 'default/user/reset_password/$1/$2';
/**
* Detail article
*/
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)\.html$'] = 'default/PathsController/index/$1/$2';
// Project
$route['^du-an/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-qh([0-9-_]+)\.htm$'] = 'default/project/getProjectByDistrict/$1/$2/$3/$4';
$route['^du-an/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-tp([0-9-_]+)\.htm$'] = 'default/project/getProjectByProvince/$1/$2/$3';
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-dn([0-9-_]+)$'] = 'default/realestate/showRealestateByProject/$1/$2/$3';
/**
* Real
*/
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-([0-9-_]+)$'] = 'default/realestate/showRealestateById/$1/$2/$3';
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-tp([0-9-_]+)\.htm$'] = 'default/realestate/showRealestateByProvince/$1/$2/$3';
$route['^([a-zA-Z0-9-_]+)/([0-9-_]+)/([a-zA-Z0-9-_]+)/trang$'] = 'default/realestate/showRealestateByProvince/$1/$2/$3';
$route['^([a-zA-Z0-9-_]+)/([0-9-_]+)/([a-zA-Z0-9-_]+)/trang/(:num)$'] = 'default/realestate/showRealestateByProvince/$1/$2/$3/$4';

$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)\.htm$'] = 'default/realestate/showRealestateByDistrict/$1/$2/$3';
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/trang$'] = 'default/realestate/showRealestateByDistrict/$1/$2/$3/$4';
$route['^([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)/trang/(:num)$'] = 'default/realestate/showRealestateByDistrict/$1/$2/$3/$4/$5';
/* End of file routes.php */
/* Location: ./application/config/routes.php */