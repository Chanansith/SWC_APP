<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contract extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in_source();

        $this->data['page_title'] = 'Contract';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
		$this->load->model('disposal_model');
        $this->load->model('log_model');
		$this->load->model('truck_model');
    }

    /* 
    * It only redirects to the manage product page
    */
    public function index()
    {
        
		$data["ContractRecords"]=$this->contract_model->getContractByUser($_SESSION["userId"]);
        $this->loadViews('contract/index_contract', $this->global, $data, NULL);
    }

    public function fetchDataById($id) 
	{
		if($id) {
			$data = $this->contract_model->getData($id);
			echo json_encode($data);
		}

		return false;
	}

    /*
    * It Fetches the customers data from the product table 
    * this function is called from the datatable ajax function
    */
  
	function add()
    {
      
            $this->global['pageTitle'] = 'Add Contract';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["sizelist"]=$this->truck_model->getSizeForDropdown();
			$data["contract_code"]=$this->contract_model->getAutoContractCode($_SESSION["userId"]);
          
            $this->loadViews("contract/addNew", $this->global, $data, NULL);
        
    }
	public function create()
	{
		

		$response = array();

		$this->form_validation->set_rules('contract_code', 'contract_code', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

			$contract_date=$this->input->post('contract_date');
			$end_date=$this->input->post('end_date');
        	$data = array(
				'contract_code' => $this->input->post('contract_code'),
				'user_id' => $_SESSION["userId"],
				'contract_date' => $contract_date,
				'end_date' => $end_date,
				'transportid' => 0,
				'disposalid' => $this->input->post('disposalid'),
				'ship_price' => $this->input->post('ship_price'),
				'disposal_qty' =>0,
				'size_amount' => 0,
				'trip_rate' => 0,
				'contract_amount' => 0,
				'contract_create_name' => $this->input->post('contract_create_name'),
        	);

        	$create = $this->contract_model->create($data);
        	if($create == true) {
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

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_name', 'Category name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'front_regis_no' => $this->input->post('edit_front_regis_no'),
					'back_regis_no' => $this->input->post('back_regis_no')
	        	);

	        	$update = $this->contract_model->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'บันทึกเรียบร้อย';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'พบข้อผิดพลาด';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the category information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$supplier_id = $this->input->post('supplier_id');

		$response = array();
		if($supplier_id) {
			$delete = $this->contract_model->remove($supplier_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}
