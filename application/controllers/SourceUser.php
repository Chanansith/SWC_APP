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
        $this->load->model('payment_model');
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
		
		//echo json_encode($contract);
		print_r($contract);
	}

    function getpaymentbycontract($contract_id){
		$data["payementsRecords"]=$this->payment_mode->getPaymentByContract($contract_id);
        $this->loadViews('payments/index_payment', $this->global, $data, NULL);
	}

	function addpayment($contract_id)
    {
      
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
    public function createpayment()
	{
		

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
				$this->upload_image($create);
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
