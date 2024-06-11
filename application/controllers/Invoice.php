<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Invoice extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->invoice_model->invoiceListingCount( $searchText);
            $returns = $this->paginationCompress("invoice/", $count, 25);
            
            $data['invoiceRecords'] = $this->invoice_model->invoiceListing( $searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = 'Invoice List';
            $this->loadViews("invoice/index", $this->global, $data, NULL);
        }
    }
    public function checkpage()
    {
        $searchText="";
        $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->invoice_model->invoiceListingCount( "");
            echo  $count;
            $returns = $this->paginationCompress("invoice/", $count, 10);
            print_r($returns);
            $returns["page"]=25;
            $returns["segment"]=25;
            $data['invoiceRecords'] = $this->invoice_model->invoiceListing( $searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = 'Invoice List';
            $this->loadViews("invoice/index", $this->global, $data, NULL);
        
    }
    public function index2()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->invoice_model->invoiceListingCount( $searchText);
            print_r($count);

          
            $returns = $this->paginationCompress("invoice/", $count, 10);
            print_r("page".$returns["page"]);
            print_r("segment".$returns["segment"]);
            $data['invoiceRecords'] = $this->invoice_model->invoiceListing( $searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = 'Invoice List';
            $this->loadViews("invoice/index2", $this->global, $data, NULL);
        }
    }
    function addInvoice(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Add Invoice';
            $data['branch'] = $this->invoice_model->getBranch();
            $this->loadViews("invoice/addNewInvoice", $this->global, $data, NULL);
        }
    }
    function addNewInvoice(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $carno = $this->input->post('carno');
            $date = $this->input->post('date');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $cost = $this->input->post('cost');
            $address = $this->input->post('address');
            $detail = $this->input->post('detail');
            $branch = $this->input->post('branch');
            $type = $this->input->post('type');
            $data = array(
                'carno' => $carno,
                'date' => $date,
                'name' => $name,
                'phone' => $phone,
                'cost' => $cost,
                'address' => $address,
                'detail' => $detail,
                'branch'=>$branch,
                'type'=>$type,
                'create_by' => $this->vendorId,
                'create_at' => date('Y-m-d H:i:s')
            );
            if (!empty($_FILES['image']["name"])) {
                $image = $this->upload_image('image');
                $data['evidence'] = 'assets/imageEvidence/' . $image['upload_data']['file_name'];
                // $data['image'] = $image;
            }

            $result = $this->invoice_model->addNewInvoice($data);


            if ($result > 0) {
                $this->invoice_model->carReserveInvoice($carno);
                $response = array(
                    "messages" => "success"
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    } 
    function editInvoice($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Edit Invoice';
            $data['InvoiceRecord'] = $this->invoice_model->getInvoice($id);
            $data['branch'] = $this->invoice_model->getBranch();
            $this->loadViews("invoice/editOldInvoice", $this->global, $data, NULL);
        }
    }
    function editOldInvoice(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $id = $this->input->post('id');
            $carno = $this->input->post('carno');
            $date = $this->input->post('date');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $cost = $this->input->post('cost');
            $address = $this->input->post('address');
            $detail = $this->input->post('detail');
            $branch = $this->input->post('branch');
            $type = $this->input->post('type');
            $data = array(
                'carno' => $carno,
                'date' => $date,
                'name' => $name,
                'phone' => $phone,
                'cost' => $cost,
                'address' => $address,
                'detail' => $detail,
                'branch'=>$branch,
                'type'=>$type,
                'update_by' => $this->vendorId,
                'update_at' => date('Y-m-d H:i:s')
            );
            $result = $this->invoice_model->editOldInvoice($id,$data);


            if ($result > 0) {
                $response = array(
                    "messages" => "success"
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function deleteInvoice(){
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('is_delete' => 1, 'update_at' => date('Y-m-d H:i:s'),'update_by' =>$this->vendorId);

            $result = $this->invoice_model->editOldInvoice($id, $data);


            if ($result > 0) {
                $response = array(
                    "messages" => "success"
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
            // redirect('business','refresh');
        }
    }
    function printInvoice($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Print Invoice';
            $data['InvoiceRecord'] = $this->invoice_model->getInvoice($id);
            $this->load->view("invoice/printInvoice",  $data);
        }
    }
    function searchCarInvoice(){
        $search = $this->input->post('search');
        $carRecords = $this->invoice_model->carListing($search, 10, 0);
        echo json_encode($carRecords);
    }
    function upload_image($imageFile)
    {
        $config['upload_path']          = './assets/imageEvidence';
        $config['file_name']            =  $imageFile.uniqid();
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2048; //2MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($imageFile)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata($error);
            // $this->addbns();
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }
}