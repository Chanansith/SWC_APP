<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Transport extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
     
        $this->data['page_title'] = 'Transport';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
        $this->load->model('request_model');
		$this->load->model('disposal_model');
        $this->load->model('province_model');
        $this->load->model('log_model');
        $this->load->model('user_model');
    }
    public function index()
    {
        $this->not_logged_in_transport();
        $data["summary"]=[];
        $this->loadTransportViews('transport/transdasboard', $this->global, $data, NULL);
        
    }
    public function monitordisposal($diposal_id)
    {
        $this->not_logged_in_transport();
		$data["monitoring_record"]=$this->disposal_model->getMonitoring($diposal_id);
        $this->loadTransportViews('transport/dis_monitoring', $this->global, $data, NULL);
    }



    function addTransport($request_id,$contract_id)
    {
      
           $this->not_logged_in_transport();
            $this->global['pageTitle'] = 'Add Transport';
            $data['header'] ="Transport";
            $contract=$this->contract_model->getContract($contract_id);
            $data["monitoring_record"]=$this->disposal_model->getMonitoring($diposal_id);
			$data["contract"]=$contract[0];
			$data["contract_code"]=$contract[0]->contract_code;
            $data["contract_id"]=$contract_id;
            $data["request_id"]=$request_id;
			
            $this->loadTransportViews("transport/addNewTran", $this->global, $data, NULL);
        
    }
    function addNewShipUser()
    {
        
          
        $data["title"]="index";
        $this->global["name"]="guess";
        $this->global["pageTitle"]="home";
        $data["provinces"]=$this->province_model->getProvinces();
       
        $this->loadViewsNoHeader("addNewshipuser", $this->global, $data, NULL);
        
    }
    function saveNewShipUser()
    {
        

        $this->log_model->create(
            array('createby'=>0,
         'remark'=>"36",
         'log_type'=>"new transport")
        );
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fullname','ชื่อนามสกุล','required|max_length[255]');
            $this->form_validation->set_rules('mobile_no','เบอร์โทรศัพท์มือถือ','required|max_length[20]');
         
            
            if($this->form_validation->run() == FALSE)
            {
               // $this->addNewShipUser();
              
               redirect( base_url_api.'registershipping', 'refresh');
            }
            else
            {
                $mobile = $this->input->post('mobile_no');
               

                 $code = $this->input->post('code');
                 $hascode = $this->input->post('hascode');
                 $companyname = $this->input->post('companyname');
                 $title = $this->input->post('title');
                 $fullname = $this->input->post('fullname');
               
                 $address_no = $this->input->post('address_no');
                 $moo = $this->input->post('moo');
                 $zipcode = $this->input->post('zipcode');
                 $provinceid = $this->input->post('province');
                 $districtid = $this->input->post('district');
                 $amphurid = $this->input->post('amphure');
                 $tel = $this->input->post('tel_no');
                 $mobile = $this->input->post('mobile_no');
                 $email = $this->input->post('email');
                 $lat = $this->input->post('lat');
                 $lng = $this->input->post('lng');
               
                 $password=$this->input->post('password');
                 $registerno = $this->input->post('registerno');
                 
                // // $secret_key = $this->input->post('secret_key');
                // // $myreferral = $this->input->post('myreferral');
                    $userInfo = array('email'=>$email,  'companyname'=> $companyname,'code'=>$code,'hascode'=>$hascode,
                                         'title'=>$title,'full_name'=>$fullname,
                                        'address_no'=>$address_no,'moo'=>$moo,
                                         'mobile_no'=>$mobile,  'tel_no'=>$tel,
                                         'provinceid'=>$provinceid,'districtid'=>$districtid,'amphurid'=>$amphurid,
                                         'lat'=>$lat,'lng'=>$lng,
                                         'registerno'=>$registerno,'pass'=>$password,
                                         'createon'=>date('Y-m-d H:i:s'));
                    
           
                                         $this->log_model->create(
                                            array('createby'=>0,
                                         'remark'=>"105",
                                         'log_type'=>"new transport")
                                        );

                    $result = $this->transport_model->addTransportUser($userInfo);

                    //upload file after
                    
                    if($result > 0)
                    {
                        
                        $this->log_model->create(
                            array('createby'=>0,
                         'remark'=>"118",
                         'log_type'=>"new transport")
                        );

                        $this->session->set_flashdata('success', 'สมัครสมาชิกเรียบร้อย');
                        redirect( base_url_api.'login/transport', 'refresh');
                    }
                    else
                    {
                        $this->log_model->create(
                            array('createby'=>0,
                         'remark'=>"129",
                         'log_type'=>"new transport")
                        );
                        $this->session->set_flashdata('error', 'พบข้อผิดพลาด');
                        redirect( base_url_api.'registershipping', 'refresh');
                     
                    }
                    
                  
               
            }
        
    }
	public function create()
	{
		
	    $this->not_logged_in_transport();;

		$response = array();

		$this->form_validation->set_rules('contract_code', 'contract_code', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"169",
			 'log_type'=>"tran")
			);
            $tran_date=$this->input->post('tran_date');
        	$data = array(
				'contract_code' => $this->input->post('contract_code'),
                'contract_id' => $this->input->post('contract_id'),
                'request_id' => $this->input->post('request_id'),
                'disposal_qty' => $this->input->post('disposal_qty'),
				'tran_by' => $_SESSION["userId"],
                'tran_date' => $tran_date,
                'tran_create_name' => $this->input->post('tran_create_name'),
        	);
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"182",
			 'log_type'=>"tran")
			);
			
			
			
        	$create = $this->transport_model->create($data);
        	if($create >0) {
				
				$this->log_model->create(
					array('createby'=>0,
				 'remark'=>"193 success",
				 'log_type'=>"tran")
				);
				
				redirect( base_url_api.'contract', 'refresh');
        		// $response['success'] = true;
        		// $response['messages'] = 'Succesfully created';
			
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the  information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}


    public function contract()
    {
        $this->not_logged_in_transport();
		$data["ContractRecords"]=$this->contract_model->getContractByTransport($_SESSION["userId"]);
        $this->loadTransportViews('transport/trans_contract', $this->global, $data, NULL);
    }

    public function requestlist()
    {
        $this->not_logged_in_transport();
		$data["RequestRecords"]=$this->request_model->getRequest($_SESSION["userId"]);
        $this->loadTransportViews('transport/request_list', $this->global, $data, NULL);
    }
    public function transportitem()
    {
        $this->not_logged_in_transport();
		$data["TranRecords"]=$this->transport_model->getDataByID($_SESSION["userId"]);
        $this->loadTransportViews('transport/tran_list', $this->global, $data, NULL);
    }

    public function signout(){
        
        session_destroy();
        redirect( base_url_api.'login/transport', 'refresh');

    }
   
}
