<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SourceUser extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Source of IMW';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
		$this->load->model('disposal_model');
        $this->load->model('log_model');
    }

    /* 
    * It only redirects to the manage product page
    */
    public function index()
    {
        echo "index";
    }
  
    public function fetchDataById($id) 
	{
	 echo "";
	}

  
	function addpayment()
    {
      
            $this->global['pageTitle'] = 'Add Payment';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["sizelist"]=$this->truck_model->getSizeForDropdown();
			$data["contract_code"]=$this->contract_model->getAutoContractCode($_SESSION["userId"]);
          
            $this->loadViews("payment/add_payment", $this->global, $data, NULL);
        
    }


    public function signout(){
        
        session_destroy();
        redirect( base_url_api.'login/hn', 'refresh');

    }
}
