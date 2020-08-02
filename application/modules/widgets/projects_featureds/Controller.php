<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Projects_featureds_widget extends MY_Widget
{
    function index(){
    	$this->load->model('mprojects');
        $this->load->view('view',array(
                                        'project_featureds' => $this->mprojects->featureds(),
                                        'moreFeatureds'     => $this->mprojects->moreFeatureds()
                                      ));
    }
}