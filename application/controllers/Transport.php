<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Transport extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
     
        $this->not_logged_in();

        $this->data['page_title'] = 'Transport';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
        $this->load->model('request_model');
		$this->load->model('disposal_model');
        $this->load->model('log_model');
    }
    public function index()
    {
        $data["summary"]=[];
        $this->loadTransportViews('transport/transdasboard', $this->global, $data, NULL);
        
    }
    public function contract()
    {
        
		$data["ContractRecords"]=$this->contract_model->getContractByTransport($_SESSION["userId"]);
        $this->loadTransportViews('transport/trans_contract', $this->global, $data, NULL);
    }

    public function requestlist()
    {
        
		$data["RequestRecords"]=$this->request_model->getRequest($_SESSION["userId"]);
        $this->loadViews('transport/request_list', $this->global, $data, NULL);
    }
    public function signout(){
        
        session_destroy();
        redirect('login/transport', 'refresh');

    }
   
}
