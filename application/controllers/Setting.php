<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Setting extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('language_model');
        $this->load->model('language_model');
        $this->isLoggedIn();   
    }
    function company_info(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->load->library('pagination');
            $data['language'] = $this->language;
            $this->global['pageTitle'] = 'Company Setting';

            $this->loadViews("setting/index", $this->global, $data, NULL);
        }
    }
}