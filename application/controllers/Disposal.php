<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Disposal extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in_disposal();

        $this->data['page_title'] = 'disposal';

		$this->load->model('contract_model');
		$this->load->model('transport_model');
		$this->load->model('disposal_model');
		$this->load->model('source_model');
		$this->load->model('truck_model');
        $this->load->model('log_model');
    }

    /* 
    * It only redirects to the manage product page
    */
    public function index()
    {
        $data["summary"]=[];
        $this->loadDisposalViews('disposal/disposaldashboard', $this->global, $data, NULL);
    }
	public function contract()
    {
        
		$data["ContractRecords"]=$this->contract_model->getContractByDisposal($_SESSION["userId"]);
        $this->loadDisposalViews('disposal/dis_contract', $this->global, $data, NULL);
    }
  
	public function transportitem()
    {
        $this->not_logged_in_transport();
		$data["TranRecords"]=$this->disposal_model->getMyTransport($_SESSION["userId"]);
        $this->loadDisposalViews('disposal/dis_tran_list', $this->global, $data, NULL);
    }
	public function approveTransport($id)
    {
        $this->not_logged_in_transport();
		$data = array(
			'approve_status' => 2
		);
		$this->transport_model->updateTransport($data,$id);
		$data["TranRecords"]=$this->disposal_model->getMyTransport($_SESSION["userId"]);
        $this->loadDisposalViews('disposal/dis_tran_list', $this->global, $data, NULL);
    }
	public function direction($id)
    {
        $this->not_logged_in_transport();
		
		$data["id"]=$id;
		$contract=$this->contract_model->getContractByDisposal($_SESSION["userId"]);
		$sourceuser=$this->source_model->getData($contract[0]->user_id);
		$data["source_name"]=$sourceuser[0]->companyname;
		$data["destination_name"]=$_SESSION['direction_name'];
		
        $this->loadDisposalViews('disposal/dis_direction_detail', $this->global, $data, NULL);
    }
	public function direction_test($id)
    {
        $this->not_logged_in_transport();
		//php try catch
		try {
	
		$contract=$this->contract_model->getContractByDisposal($_SESSION["userId"]);
		$sourceuser=$this->source_model->getData($contract[0]->user_id);
		print_r($contract);
	    print_r($sourceuser[0]->companyname);
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}
	public function pendingTransport($id)
    {
        $this->not_logged_in_transport();
		$data = array(
			'approve_status' => 1
		);
		$this->transport_model->updateTransport($data,$id);
		$data["TranRecords"]=$this->disposal_model->getMyTransport($_SESSION["userId"]);
        $this->loadDisposalViews('disposal/dis_tran_list', $this->global, $data, NULL);
    }
    public function fetchDataById($id) 
	{
		if($id) {
			$data = $this->disposal_model->getData($id);
			echo json_encode($data);
		}

		return false;
	}

    /*
    * It Fetches the customers data from the product table 
    * this function is called from the datatable ajax function
    */
    public function fetchData()
    {
        $result = array('data' => array());

        $data = $this->disposal_model->getData();

        foreach ($data as $key => $value) {

           
            // button
            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }
          
            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $result['data'][$key] = array(
				$value['front_regis_no'],
                $value['back_regis_no'],
               
                $availability,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
	}
	
	function addcontract()
    {
      
            $this->global['pageTitle'] = 'Add Contract';
            $data['header'] ="Contract";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["sizelist"]=$this->truck_model->getSizeForDropdown();
			$data["contract_code"]=$this->contract_model->getAutoContractCode($_SESSION["userId"]);
          
            $this->loadDisposalViews("disposal/addNewContract", $this->global, $data, NULL);
        
    }
	function add()
    {
      
            $this->global['pageTitle'] = 'Add disposal';
            $data['header'] ="disposal";
			$data["transportlist"]=$this->transport_model->getForDropdown();
			$data["disposallist"]=$this->disposal_model->getForDropdown();
			$data["disposal_code"]=$this->disposal_model->getAutodisposalCode($_SESSION["userId"]);
          
            $this->loadDisposalViews("disposal/addNew", $this->global, $data, NULL);
        
    }

	public function createcontract()
	{
		

		$response = array();

		$this->form_validation->set_rules('contract_code', 'contract_code', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

			$contract_date=$this->input->post('contract_date');
        	$data = array(
				'contract_code' => $this->input->post('contract_code'),
				'user_id' => $_SESSION["userId"],
				'contract_date' => $contract_date,
				'transportid' => $this->input->post('transportid'),
				'disposalid' =>  $_SESSION["userId"],
				'ship_price' => $this->input->post('ship_price'),
				'disposal_qty' => $this->input->post('disposal_qty'),
				'size_amount' => $this->input->post('size_amount'),
				'trip_rate' => $this->input->post('trip_rate'),
				'contract_amount' => $this->input->post('contract_amount'),
				'contract_create_name' => $this->input->post('contract_create_name'),
        	);

        	$create = $this->disposal_model->addContract($data);
        	if($create == true) {
				redirect( base_url_api.'disposal/contract', 'refresh');
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

	public function create()
	{
		

		$response = array();

		$this->form_validation->set_rules('disposal_code', 'disposal_code', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {

			$disposal_date=$this->input->post('disposal_date');
        	$data = array(
				'disposal_code' => $this->input->post('disposal_code'),
				'user_id' => $_SESSION["userId"],
				'disposal_date' => $disposal_date,
				'transportid' => $this->input->post('transportid'),
				'disposalid' => $this->input->post('disposalid'),
				'ship_price' => $this->input->post('ship_price'),
				'disposal_qty' => $this->input->post('disposal_qty'),
				'disposal_amount' => $this->input->post('disposal_amount'),
				'disposal_create_name' => $this->input->post('disposal_create_name'),
        	
        	
        	);

        	$create = $this->disposal_model->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
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

	        	$update = $this->disposal_model->update($data, $id);
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
			$delete = $this->disposal_model->remove($supplier_id);
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


    public function signout(){
        session_destroy();
        redirect( base_url_api.'login/disposal', 'refresh');

    }
}
