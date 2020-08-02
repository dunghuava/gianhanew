<?php
/**
 * My Access
 * 
 * @author Pham Quoc Hieu quochieuhcm@gmail.com  | 0949.133.224 
 * @copyright 2015
 */
class Access{
    public $_CI;
    protected $_roles;
    protected $_permissions;
    public function __construct(){
        $this->_CI =& get_instance();
    }
    public function start(){
        $this->_CI->zend->load('Zend_Acl');
        $this->load();
        $this->setRoles();
        $this->setResources();
        $this->setAccess();
        $module = $this->_CI->router->fetch_module();
        $controller = $this->_CI->router->fetch_class();
        $action = $this->_CI->router->fetch_method();
        $level = $this->_CI->session->userdata('user_level');
        /**
        * Default $role = 'gues'
        */
        $role = 'guest';
        switch($level){
            case '1':
                $role = 'supperadmin'; // Hệ thống
                break;
            case '2':
                $role = 'admin';       // Nhóm quản trị 
                break;
            case '3':
                $role = 'moderator';   // Nhóm biên tập viên
                break;
            case '4':
                $role = 'collaborators';   // Nhóm Cộng tác viên bài viết
                break;
        }
        if(!$this->_CI->Zend_Acl->isAllowed($role, $module .':'. $controller, $action)){
            if ($level == false) {
                redirect(base_url().'login.html');
            }else{
                if($level == 4){
                    redirect(base_url());
                }else{
                    $this->_CI->session->set_flashdata('error','Bạn không có quyền truy cập vào chức năng này');
                    redirect(base_url().'admin');
                } 
            }
        }
    }
    /**
    * setRoles
    * 
    */
    public function setRoles()
    {
        $this->_CI->Zend_Acl->addRole(new Zend_Acl_Role('guest'));
        $this->_CI->Zend_Acl->addRole(new Zend_Acl_Role('collaborators'));
        $this->_CI->Zend_Acl->addRole(new Zend_Acl_Role('moderator'), 'collaborators');
        $this->_CI->Zend_Acl->addRole(new Zend_Acl_Role('admin'), 'moderator');
        $this->_CI->Zend_Acl->addRole(new Zend_Acl_Role('supperadmin'), 'admin');
    }
    /**
    * Set Resources have in your system
    * 
    */
    public function setResources(){
        $this->_CI->Zend_Acl->add(new Zend_Acl_Resource('admin'))
                            ->add(new Zend_Acl_Resource('auth'))
                            ->add(new Zend_Acl_Resource('default'))
                            // Dashboard
                            ->add(new Zend_Acl_Resource('admin:dashboard'),'admin')
                            ->add(new Zend_Acl_Resource('admin:users'),'admin')
                            ->add(new Zend_Acl_Resource('admin:articles'),'admin')
                            ->add(new Zend_Acl_Resource('admin:settings'),'admin')
                            ->add(new Zend_Acl_Resource('admin:category'),'admin')
                            ->add(new Zend_Acl_Resource('admin:menus_items'),'admin')
                            ->add(new Zend_Acl_Resource('admin:menu_groups'),'admin') 
                            ->add(new Zend_Acl_Resource('admin:pages'),'admin')
                            ->add(new Zend_Acl_Resource('admin:contacts'),'admin')
                            ->add(new Zend_Acl_Resource('admin:ajax'),'admin')
                            ->add(new Zend_Acl_Resource('admin:profile'),'admin')
                            ->add(new Zend_Acl_Resource('admin:usertrackers'),'admin')
                            ->add(new Zend_Acl_Resource('admin:content_blocks'),'admin')
                            ->add(new Zend_Acl_Resource('admin:viewcomposer'),'admin')
                            ->add(new Zend_Acl_Resource('admin:provinces'),'admin')
                            ->add(new Zend_Acl_Resource('admin:districts'),'admin')
                            ->add(new Zend_Acl_Resource('admin:streets'),'admin')
                            ->add(new Zend_Acl_Resource('admin:sliders'),'admin')
                            ->add(new Zend_Acl_Resource('admin:sliders_groups'),'admin')
                            ->add(new Zend_Acl_Resource('admin:projects'),'admin')
                            ->add(new Zend_Acl_Resource('admin:general_slugs'),'admin')
                            ->add(new Zend_Acl_Resource('admin:realestates'),'admin')
                            ->add(new Zend_Acl_Resource('admin:external_links'),'admin')
                            ->add(new Zend_Acl_Resource('admin:tools'),'admin')
                            ->add(new Zend_Acl_Resource('admin:tool_project'),'admin')
                            ->add(new Zend_Acl_Resource('admin:group_advertings'),'admin')
                            ->add(new Zend_Acl_Resource('admin:advertings'),'admin')
                            ->add(new Zend_Acl_Resource('admin:links_auto'),'admin')
                            // Resource
                            ->add(new Zend_Acl_Resource('auth:authentication'),'auth')
                            ->add(new Zend_Acl_Resource('default:home'),'default')
                            ->add(new Zend_Acl_Resource('default:offline'),'default')
                            ->add(new Zend_Acl_Resource('default:page'),'default')
                            ->add(new Zend_Acl_Resource('default:categories'),'default')
                            ->add(new Zend_Acl_Resource('default:user'),'default')
                            ->add(new Zend_Acl_Resource('default:seo'),'default')
                            ->add(new Zend_Acl_Resource('default:article'),'default')
                            ->add(new Zend_Acl_Resource('default:project'),'default')
                            ->add(new Zend_Acl_Resource('default:realestate'),'default')
                            ->add(new Zend_Acl_Resource('default:ajax'),'default')
                            ->add(new Zend_Acl_Resource('default:handler'),'default')
                            ->add(new Zend_Acl_Resource('default:test'),'default')
                            ->add(new Zend_Acl_Resource('default:cron'),'default')
                            ->add(new Zend_Acl_Resource('default:PathsController'),'default')
                            ->add(new Zend_Acl_Resource('default:postting'),'default');
                            
    }
    public function setAccess(){
        // Default Guest
        $this->_CI->Zend_Acl->allow('guest', array('default', 'auth'))
                            ->allow('collaborators', array('default', 'auth'))
                            ->allow('moderator',array('admin:dashboard','admin:articles','admin:projects','admin:districts','admin:profile'))
                            ->allow('admin', array('admin:users','admin:menus_items','admin:pages'))
                            ->allow('supperadmin',null);
    }
    /**
    *
    */
    public function load()
    {
        $setting = $this->_CI->msetting->get_setting_site();
        // Check
        $sets = ($setting['value'] != "") ? json_decode($setting['value']) : json_decode($setting['default']);
        date_default_timezone_set($sets->timezone);
        // Define some global constants for application
        define('DOMAIN_NAME', $sets->domain_name);
        define('SITENAME', $sets->sitename);
        define('SITE_KEYWORDS', $sets->meta_keywords);
        define('SITE_DESCRIPTION', $sets->meta_description);
        define('OFFLINE_NOTIFY', $sets->offline_notify);
        define('LOGOSITE', $sets->logo);
        define('SHOW_TITLE', $sets->show_title);
        // SEO
        define('ALEXA_VERIFY_ID', $sets->alexa_verify_id);
        define('GOOGLE_MASTER_TOOL', $sets->google_site_verification);
        define('GOOGLE_ANALYTICS', $sets->google_analytics);
        // END SEO
        $articles = $this->_CI->msetting->get_setting_site_by_param('article');
        $article = ($articles['value'] !="") ? json_decode($articles['value']) : json_decode($articles['default']);
        define('MAX_WIDTH_ARTICLE', $article->thumbnail_max_width);
        define('MAX_HEIGHT_ARTICLE', $article->thumbnail_max_height);
        define('ARTICLE_RECORD_PER_PAGE',$article->record_per_page);
        define('ARTICLE_PAGE_PER_SEGMENT',$article->page_per_segment);
        // du an
        $projects = $this->_CI->msetting->get_setting_site_by_param('project');
        $project = ($projects['value'] !="") ? json_decode($projects['value']) : json_decode($projects['default']);
        define('MAX_WIDTH_PROJECT', $project->thumbnail_max_width);
        define('MAX_HEIGHT_PROJECT', $project->thumbnail_max_height);
        define('PROJECT_RECORD_PER_PAGE',$project->record_per_page);
        define('PROJECT_PAGE_PER_SEGMENT',$project->page_per_segment);
        // Real
        $realestates = $this->_CI->msetting->get_setting_site_by_param('realestate');
        $realestate = ($realestates['value'] !="") ? json_decode($realestates['value']) : json_decode($realestates['default']);
        define('MAX_WIDTH_REALESTATE', $realestate->thumbnail_max_width);
        define('MAX_HEIGHT_REALESTATE', $realestate->thumbnail_max_height);
        define('REALESTATE_RECORD_PER_PAGE',$realestate->record_per_page);
        define('REALESTATE_PAGE_PER_SEGMENT',$realestate->page_per_segment);
        define('PATH_URL', base_url().'resizer/timthumb.php');
    }
}