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
		$this->load->model('truck_model');
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
  
    public function fetchDataById($contract_id) 
	{
		$contract=$this->contract_model->getContract($contract_id);
		
		echo json_encode($contract);
	}

  
	function addpayment($contract_id)
    {
      
            $this->global['pageTitle'] = 'Add Payment';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["sizelist"]=$this->truck_model->getSizeForDropdown();
			$contract=$this->contract_model->getContract($contract_id);
			$data["contract"]=$contract;
			$data["contract_code"]=$contract[0]["contract_code"];
          
            $this->loadViews("payment/add_payment", $this->global, $data, NULL);
        
    }


    public function signout(){
        
        session_destroy();
        redirect( base_url_api.'login/hn', 'refresh');

    }
}
