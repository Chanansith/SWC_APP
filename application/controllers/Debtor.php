<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Debtor extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('debtor_model');
        $this->load->model('car_model');
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
            $count = $this->debtor_model->debtorListingCount($searchText);
            $returns = $this->paginationCompress("debtor/", $count, 50);

            $data['debtorRecords'] = $this->debtor_model->debtorListing($searchText, $returns["page"], $returns["segment"]);
            for($i=0;$i<$count;$i++){
                if (isset( $data['debtorRecords'][$i])){
                    $data['debtorRecords'][$i]->tentPay = $this->debtor_model->debtorTentPayListing($data['debtorRecords'][$i]->id);
                    $data['debtorRecords'][$i]->tentReceive = $this->debtor_model->debtorTentReceiveListing($data['debtorRecords'][$i]->id);
                }
            }
            // $data['count'] = $count;
            $this->global['pageTitle'] = 'Debtor';
            // echo json_encode($sumvalue);
            // echo json_encode($data);
            $this->loadViews("debtor/index", $this->global, $data, NULL);
        }
    }
    function addDebtor()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->global['pageTitle'] = 'Debtor';
            $this->loadViews("debtor/addNew", $this->global, NULL, NULL);
        }
    }
    function addNewDebtor()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->global['pageTitle'] = 'Debtor';
            $carno = $this->input->post('carno');
            $name = $this->input->post('name');
            $bank = $this->input->post('bank');
            // $image = $_FILES['image']['name'];
            $data = array(
                'carno' => $carno,
                'name' => $name,
                'bank' => $bank,
                // 'evidence'=>$image,
                'create_by' => $this->vendorId
            );
            $result = $this->debtor_model->addNewDebtor($data);

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function editDebtor($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->global['pageTitle'] = 'Debtor';
            $data['debtorRecords'] = $this->debtor_model->GetDebtorById($id);
            $data['id'] = $id;
            $this->loadViews("debtor/editOld", $this->global, $data, NULL);
        }
    }
    function editOldDebtor(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->global['pageTitle'] = 'Debtor';
            $carno = $this->input->post('carno');
            $id = $this->input->post('id');
            $deptor_remark	 = $this->input->post('deptor_remark');
            // $bank = $this->input->post('bank');
            $data = array(
                'carno' => $carno,
                'update_by' => $this->vendorId,
                'deptor_remark' => $deptor_remark,
                'update_at' => date('Y-m-d H:i:s')
            );
            $result = $this->debtor_model->editOldDebtor($id,$data);

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function deleteDebtor(){
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('is_delete' => 1, 'update_at' => date('Y-m-d H:i:s'),'update_by' =>$this->vendorId);

            $result = $this->debtor_model->editOldDebtor($id, $data);


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
    function debtorTentPay($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            // $this->load->library('pagination');
            // $count = $this->debtor_model->debtorTentPayListingCount($id,$searchText);
            // $returns = $this->paginationCompress("debtorTentPay/", $count, 10);

            $data['debtorTentPayRecords'] = $this->debtor_model->debtorTentPayListing($id,$searchText);

            $data['id'] = $id;
            $this->global['pageTitle'] = 'Debtor Tent Pay';
            // echo json_encode($sumvalue);
            // echo json_encode($data);
            $this->loadViews("debtor/debtorTentPay", $this->global, $data, NULL);
        }
    }
    function addDebtorTentPay($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['id'] = $id;
            $this->global['pageTitle'] = 'Debtor Tent Pay';
            $this->loadViews("debtor/addNewDebtorTentPay", $this->global, $data, NULL);
        }
    }
    function addNewDebtorTentPay(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Debtor Tent Pay';
            $date = $this->input->post('date');
            $cost = $this->input->post('cost');
            $debtor_id = $this->input->post('debtor_id');
            $data = array(
                'debtor_id' => $debtor_id,
                'date' => $date,
                'cost' => $cost,
                'create_by' => $this->vendorId
            );

            $result = $this->debtor_model->addNewDebtorTentPay($data);

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function editDebtorTentPay($id,$editId){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['id'] = $id;
            $data['editId'] = $editId;
            $data['debtorTentPay'] = $this->debtor_model->getDebtorTentPay($editId);
            $this->global['pageTitle'] = 'Debtor Tent Pay';
            $this->loadViews("debtor/editOldDebtorTentPay", $this->global, $data, NULL);
        }
    }
    function editOldDebtorTentPay(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Debtor Tent Pay';
            $date = $this->input->post('date');
            $cost = $this->input->post('cost');
            $id = $this->input->post('id');
            $data = array(
                'date' => $date,
                'cost' => $cost,
                'update_at' => date('Y-m-d H:i:s'),
                'update_by' => $this->vendorId
            );
            $result = $this->debtor_model->editOldDebtorTentPay($id,$data);

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function deleteDebtorTentPay(){
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('is_delete' => 1, 'update_at' => date('Y-m-d H:i:s'),'update_by' =>$this->vendorId);

            $result = $this->debtor_model->editOldDebtorTentPay($id, $data);


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
    function debtorTentReceive($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            // $this->load->library('pagination');
            // $count = $this->debtor_model->debtorTentReceiveListingCount($searchText);
            // $returns = $this->paginationCompress("debtorTentReceive/", $count, 10);

            $data['debtorTentReceiveRecords'] = $this->debtor_model->debtorTentReceiveListing($id,$searchText);
            $data['id'] = $id;
            // $data['count'] = $count;
            $this->global['pageTitle'] = 'Debtor Tent Receive';
            // echo json_encode($sumvalue);
            // echo json_encode($data);
            $this->loadViews("debtor/debtorTentReceive", $this->global, $data, NULL);
        }
    }
    function addDebtorTentReceive($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['id'] = $id;
            $this->global['pageTitle'] = 'Debtor Tent Receive';
            $this->loadViews("debtor/addNewDebtorTentReceive", $this->global, $data, NULL);
        }
    }
    function addNewDebtorTentReceive(){
        $log='299';
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $result =0;
            $this->global['pageTitle'] = 'Debtor Tent Receive';
            $date = $this->input->post('date');
            $cost = $this->input->post('cost');
            $type = $this->input->post('type');
            $debtor_id = $this->input->post('debtor_id');
            $data = array(
                'debtor_id' => $debtor_id,
                'date' => $date,
                'cost' => $cost,
                'type' => $type,
                'evidence'=>"",
                'create_by' => $this->vendorId
            );
        
            $debtorTentPay = $this->debtor_model->getCostDebtorTentPay($debtor_id);
            $debtorTentReceive = $this->debtor_model->getCostDebtorTentReceive($debtor_id);
            $sumTentPay = 0;
            $sumTentReceive = 0;
            $log='322';
            foreach($debtorTentPay as $tp){
                $sumTentPay = $sumTentPay + $tp->cost;
            }
            foreach($debtorTentReceive as $tr){
                $sumTentReceive = $sumTentReceive + $tr->cost;
            }
            $log='329'.$sumTentPay.$sumTentReceive.$cost;
            $sum = (int)$sumTentPay - ((int)$sumTentReceive + (int)$cost);
            if($sum >=0 ){
                $log='330';
                if (!empty($_FILES['image']["name"])) {
                    $image = $this->upload_image('image');
                    $data['evidence'] = 'assets/imageEvidence/' . $image['upload_data']['file_name'];
                    // $data['image'] = $image;
                    $log='335';
                }
                $result = $this->debtor_model->addNewDebtorTentReceive($data);
                $log='338';
            }

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error",
                    "sum" => $sum,
                    "sumTentPay" => $sumTentPay,
                    "sumTentReceive" => $sumTentReceive,
                    "cost" => $cost,
                    "log" => $log
                );
            }
            echo json_encode($response);
        }
    }
    function editDebtorTentReceive($id,$editId){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['id'] = $id;
            $data['editId'] = $editId;
            $data['debtorTentReceive'] = $this->debtor_model->getDebtorTentReceive($editId);
            $this->global['pageTitle'] = 'Debtor Tent Receive';
            $this->loadViews("debtor/editOldDebtorTentReceive", $this->global, $data, NULL);
        }
    }
    function editOldDebtorTentReceive(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Debtor Tent Receive';
            $date = $this->input->post('date');
            $cost = $this->input->post('cost');
            $type = $this->input->post('type');
            $id = $this->input->post('id');
            $data = array(
                'date' => $date,
                'cost' => $cost,
                'type' => $type,
                'update_at' => date('Y-m-d H:i:s'),
                'update_by' => $this->vendorId
            );
            if (!empty($_FILES['image']["name"])) {
                $image = $this->upload_image('image');
                $data['evidence'] = 'assets/imageEvidence/' . $image['upload_data']['file_name'];
                // $data['image'] = $image;
            }
            $result = $this->debtor_model->editOldDebtorTentReceive($id,$data);

            if ($result > 0) {
                $response = array(
                    "messages" => "success",
                    "data" => $data
                );
            } else {
                $response = array(
                    "messages" => "error"
                );
            }
            echo json_encode($response);
        }
    }
    function deleteDebtorTentReceive(){
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('is_delete' => 1, 'update_at' => date('Y-m-d H:i:s'),'update_by' =>$this->vendorId);

            $result = $this->debtor_model->editOldDebtorTentReceive($id, $data);


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
    function searchCar()
    {
        $search = $this->input->post('search');
        $carRecords = $this->car_model->carListing($search, 10, 0);
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
