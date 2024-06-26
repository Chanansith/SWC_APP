<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        
     
        $this->isLoggedIn();
    }
    public function index($id=null)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
       
            $this->global['pageTitle'] = 'HN';
             $data['documents'] =null;
            $this->loadViews("dashboard", $this->global, $data, NULL);
        }
    }
   
}
