<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        
   
     
    }
    public function index($id=null)
    {
    
            $data["title"]="index";
            $this->global["name"]="guess";
            $this->global["pageTitle"]="home";
            $this->loadDefaultViews("home", $this->global, $data, NULL);
        
    }
   
}
