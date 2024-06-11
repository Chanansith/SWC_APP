<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Customer extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('language_model');
        $this->isLoggedIn();
    }
    public function customer()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');
            $count = $this->customer_model->customerListingCount($searchText);
            $returns = $this->paginationCompress("customerListing/", $count, 15);

            $data['customerRecords'] = $this->customer_model->customerListing($searchText, $returns["page"], $returns["segment"]);
            $data['header'] = $this->language_model->getheadercustomer();
            $data['language'] = $this->language;
            $this->global['pageTitle'] = 'Customer';

            $this->loadViews("customer/index", $this->global, $data, NULL);
        }
    }
    function addCustomer()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Add Customer';
            $data['header'] = $this->language_model->getheadercustomer();
            $data['language'] = $this->language;
            $this->loadViews("customer/addNew", $this->global, $data, NULL);
        }
    }
    function addNewCustomer()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            // $this->form_validation->set_rules('image', 'Image', 'trim|required|xss_clean');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_card_number', 'ID Card', 'trim|required|xss_clean');
            $this->form_validation->set_rules('birth_date', 'Birthday', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('customer_type', 'Customer Type', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->addCustomer();
            } else {
                $code = $this->input->post('code');
                $fullname = $this->input->post('fullname');
                $level = $this->input->post('level');
                $major = $this->input->post('major');
                $pass = $this->input->post('pass');
           


                $data = array(
                    'code' => $code,
                    'fullname' => $fullname,
                    'level' => $level,
                    'major' => $major,
                    'pass' => $pass,
                    
                );

                $result = $this->customer_model->addNewCustomer($data);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Customer created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Customer creation failed');
                }

                redirect('customer');
            }
        }
    }
    function editCustomer($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Edit Customer';
            $data['Customer'] = $this->customer_model->getCustomer($id); 
            $data['header'] = $this->language_model->getheadercustomer();
            $data['language'] = $this->language;
            $this->loadViews("customer/editOld", $this->global, $data, NULL);
        }
    }
    function editOldCustomer(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $id = $this->input->post('id');
            // $this->form_validation->set_rules('image', 'Image', 'trim|required|xss_clean');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_card_number', 'ID Card', 'trim|required|xss_clean');
            $this->form_validation->set_rules('birth_date', 'Birthday', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('customer_type', 'Customer Type', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->editCustomer($id);
            } else {
                $code = $this->input->post('code');
                $fullname = $this->input->post('fullname');
                $level = $this->input->post('level');
                $major = $this->input->post('major');
                $pass = $this->input->post('pass');
           


                $data = array(
                    'code' => $code,
                    'fullname' => $fullname,
                    'level' => $level,
                    'major' => $major,
                    'pass' => $pass,
                    
                );
                $result = $this->customer_model->editOldCustomer($data,$id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Edit Customer successfully');
                } else {
                    $this->session->set_flashdata('error', 'Edit Customer failed');
                }

                redirect('customer');
            }
        }
    }
    
    function deleteCustomer()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {   
            $id = $this->input->post('id');
            $data = array('is_deleted'=>1, 'updated_at'=>date('Y-m-d H:i:s'));
            
            $result = $this->customer_model->deleteCustomer($id, $data);
            
            // echo json_encode($result);
            $data["status"]=false;
            if($result > 0)
            {   
                $data["status"]=true;
                $this->session->set_flashdata('success', 'Delete Customer successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Delete Customer failed');
            }
            echo json_encode($data);
            // redirect('business','refresh');
        }
    }
}
