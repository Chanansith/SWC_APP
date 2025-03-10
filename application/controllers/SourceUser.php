<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SourceUser extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

    
        $this->data['page_title'] = 'Source of IMW';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
		$this->load->model('truck_model');
		$this->load->model('disposal_model');
        $this->load->model('log_model');
        $this->load->model('payment_model');
		$this->load->model('user_model');
		$this->load->model('request_model');
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
		$this->not_logged_in();
		$contract=$this->contract_model->getContract($contract_id);
		//echo json_encode($contract);
		print_r($contract);
	}
public	function saveadduser(){
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('companyname','ชื่อสถานประกอบการ','required|max_length[255]');
          
            $this->form_validation->set_rules('mobile_no','เบอร์โทรศัพท์มือถือ','required|max_length[20]');
           
             
             $this->log_model->create(
                array('createby'=>0,
             'remark'=>"check form",
             'log_type'=>"register")
            );
           

            if($this->form_validation->run() == FALSE){
               // $this->addNew();
			 
			   redirect( base_url_api.'register', 'refresh');
			}else{

                $mobile = $this->input->post('mobile_no');
                $users_exists = $this->user_model->checkUserExists($mobile);
                
                $this->log_model->create(
                    array('createby'=>0,
                 'remark'=>"check exists",
                 'log_type'=>"register")
                );
                if(count($users_exists)==0){

                    $code = $this->input->post('code');
                    $hascode = $this->input->post('hascode');
                    $companyname = $this->input->post('companyname');
                    $cate_id = $this->input->post('cate_id');
                    $sub_cate_id = $this->input->post('sub_cate_id');
                    $address_no = $this->input->post('address_no');
                    $moo = $this->input->post('sub_cate_id');
                    $zipcode = $this->input->post('zipcode');
                    $provinceid = $this->input->post('province');
                    $districtid = $this->input->post('district');
                    $amphurid = $this->input->post('amphure');
                    $tel_no = $this->input->post('tel_no');
                    $bed_count=$this->input->post('bed_count');
                    $email = $this->input->post('email');
                    $lat = $this->input->post('lat');
                    $lng = $this->input->post('lng');
                    $main_location = $this->input->post('main_location');
                    $password=$this->input->post('pass');
              
                    $userInfo = array('email'=>$email,  'companyname'=> $companyname,'code'=>$code,'hascode'=>$hascode,
                                        'address_no'=>$address_no,'moo'=>$moo,
                                         'mobile_no'=>$mobile,'cate_id'=>$cate_id, 'sub_cate_id'=>$sub_cate_id, 
                                         'provinceid'=>$provinceid,'districtid'=>$districtid,'amphurid'=>$amphurid,
                                         'lat'=>$lat,'lng'=>$lng,'main_location'=>$main_location,
                                         'pass'=>$password,
                                         'zipcode'=>$zipcode,
                                         'tel_no'=>$tel_no,
                                         'bed_count'=>$bed_count,
                                         'createon'=>date('Y-m-d H:i:s'));
                    
                                         $this->log_model->create(
                                            array('createby'=>0,
                                         'remark'=>"Begin addnew",
                                         'log_type'=>"register")
                                        );
              

                    $result = $this->user_model->addNewUser($userInfo);
                    
                    if($result > 0){
                        $this->session->set_flashdata('success', 'สมัครสมาชิกเรียบร้อย');
                        $this->log_model->create(array('createby'=>$result,
                    'remark'=>"Register",'log_type'=>"register"));
                        //$this->sendMail(" Register Success your login with $mobile and password: $password ");

                       
						redirect(base_url_api.'login/hn');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'พบข้อผิดพลาด');
                        $this->log_model->create(array('createby'=>$result,
                        'remark'=>"Register Error",'log_type'=>"register"));
						redirect( base_url_api.'register', 'refresh');
                    }//end 111
                    
                   
                }else{
                    //$this->session->set_flashdata('error', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
                    $this->form_validation->set_message('is_unique', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
					
					redirect( base_url_api.'register', 'refresh');
				}//70
                 
            }// 56
        
        
    }
	public	function testsaveadduser(){
        
		
		 

				$userInfo = array('email'=>'email',  'companyname'=>'com','code'=>'code','hascode'=>'hascode',
									'address_no'=>'addressno','moo'=>'1',
									 'mobile_no'=>'mobile','cate_id'=>0, 'sub_cate_id'=>0, 
									 'provinceid'=>0,'districtid'=>0,'amphurid'=>0,
									 'lat'=>0,'lng'=>0,'main_location'=>0,
									 'pass'=>'password',
									 'zipcode'=>'zip',
									 'tel_no'=>'te;',
									 'bed_count'=>0,
									 'createon'=>date('Y-m-d H:i:s'));
				

				$result = $this->user_model->addNewUser($userInfo);
				
			
				
			   
		
	
}

	public function getpaymentbycontract($contract_id){
		$this->not_logged_in();

		$data["paymentsRecords"]=$this->payment_model->getPaymentByContract($contract_id);
		$data["contract_id"]=$contract_id;
        $this->loadViews('payment/index_payment', $this->global, $data, NULL);
	}
	public	function addrequest($contract_id)
    {
		$this->not_logged_in();
      
            $this->global['pageTitle'] = 'Add Request';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
		
			$contract=$this->contract_model->getContract($contract_id);
			$data["contract"]=$contract[0];
			$data["contract_code"]=$contract[0]->contract_code;
            $data["contract_id"]=$contract_id;
            $this->loadViews("sourceuser/addrequest", $this->global, $data, NULL);
        
    }

	public	function addpayment($contract_id)
    {
		$this->not_logged_in();
      
            $this->global['pageTitle'] = 'Add Payment';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["sizelist"]=$this->truck_model->getSizeForDropdown();
			$contract=$this->contract_model->getContract($contract_id);
			$data["contract"]=$contract[0];
			$data["contract_code"]=$contract[0]->contract_code;
            $data["contract_id"]=$contract_id;
            $this->loadViews("payment/add_payment", $this->global, $data, NULL);
        
    }
	public function upload_image($id)
    {
	    $this->not_logged_in();

		if (!empty($_FILES['attach_file']['name'])) {
					$_FILES['file']['name'] = $_FILES['attach_file']['name'];
					$_FILES['file']['type'] = $_FILES['attach_file']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['attach_file']['tmp_name'];
					$_FILES['file']['error'] = $_FILES['attach_file']['error'];
					$_FILES['file']['size'] = $_FILES['attach_file']['size'];
					$path = 'contractpayment/'.$id;

					if (!is_dir($path)) {
						// Directory does not exist, so create it
						mkdir($path, 0777, true); // Third parameter true ensures recursive creation
						//echo "Directory created successfully";
					} 
					$config = array(
						'upload_path' => $path,
						'allowed_types' => "jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
						'file_name' => uniqid()
					);
					$this->log_model->create(
						array('createby'=>0,
					 'remark'=>"73",
					 'log_type'=>"payment")
					);
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('file')) {
						$error = $this->upload->display_errors();
						print_r($error) ;
					} else {
						$data = array('upload_data' => $this->upload->data());
						// print_r($data);
						$type = explode('.', $data['upload_data']["file_name"]);
						$type = $type[count($type) - 1];
						$path = base_url().'/'.$config['upload_path'] . '/' . $data['upload_data']["file_name"];
						$data = array(
							'attach_file' =>$path
						
							
						);
						$update = $this->payment_model->update($data, $id);
						return $update;
					}
					
					
					
				}else{
					$this->log_model->create(
						array('createby'=>0,
					 'remark'=>"error upload 101",
					 'log_type'=>"payment")
					);
					return "error";
				}
			
       
	}

	public function createrequest()
	{
		
		$this->not_logged_in();

		$response = array();

		$this->form_validation->set_rules('contract_code', 'contract_code', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"254",
			 'log_type'=>"request")
			);

        	$data = array(
				'contract_code' => $this->input->post('contract_code'),
                'contract_id' => $this->input->post('contract_id'),
				'request_by' => $_SESSION["userId"],
				'assign_to' => $this->input->post('assign_to'),
				'qty' => $this->input->post('qty'),
                'request_by_name' => $this->input->post('request_by_name'),
        	);
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"267",
			 'log_type'=>"request")
			);
			
			
			
        	$create = $this->request_model->create($data);
        	if($create >0) {
				
				$this->log_model->create(
					array('createby'=>0,
				 'remark'=>"278 success",
				 'log_type'=>"request")
				);
				
				redirect( base_url_api.'contract', 'refresh');
        		// $response['success'] = true;
        		// $response['messages'] = 'Succesfully created';
			
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
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

    public function createpayment()
	{
		
		$this->not_logged_in();

		$response = array();

		$this->form_validation->set_rules('contract_code', 'contract_code', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"109",
			 'log_type'=>"payment")
			);

			$pay_date=$this->input->post('pay_date');
        	$data = array(
				'contract_code' => $this->input->post('contract_code'),
                'contract_id' => $this->input->post('contract_id'),
				'user_id' => $_SESSION["userId"],
				'pay_date' => $pay_date,
				'pay_amount' => $this->input->post('pay_amount'),
				'remain_amount' => $this->input->post('remain_amount'),
				'amount_per_contract' => $this->input->post('amount_per_contract'),
				'payment_by' => $this->input->post('payment_by'),
				'other_detail' => $this->input->post('other_detail'),
                'bank_id' => $this->input->post('bank_id'),
        	);
			$this->log_model->create(
				array('createby'=>0,
			 'remark'=>"125",
			 'log_type'=>"payment")
			);
			
			
			
        	$create = $this->payment_model->create($data);
        	if($create >0) {
				
				$this->log_model->create(
					array('createby'=>0,
				 'remark'=>"132",
				 'log_type'=>"payment")
				);
				$this->upload_image($create);

				redirect( base_url_api.'contract', 'refresh');
        		// $response['success'] = true;
        		// $response['messages'] = 'Succesfully created';
			
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
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


    public function signout(){
        session_destroy();
        redirect( base_url_api.'login/hn', 'refresh');
    }
}
