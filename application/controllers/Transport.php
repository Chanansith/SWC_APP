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
               //echo "กรุณากรอกข้อมูลให้ครบ";

               echo "<a href=".base_url_api."registershipping class='btn btn-success'>ถัดไป</a>";
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
                        echo "<a href=".base_url_api."login/transport class='btn btn-success'>สมัครสมาชิกเรียบร้อย ถัดไป</a>";
                    }
                    else
                    {
                        $this->log_model->create(
                            array('createby'=>0,
                         'remark'=>"129",
                         'log_type'=>"new transport")
                        );
                        $this->session->set_flashdata('error', 'พบข้อผิดพลาด');
                        echo "<a href=".base_url_api."registershipping class='btn btn-success'>ถัดไป</a>";
                    }
                    
                  
               
            }
        
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
    public function signout(){
        
        session_destroy();
        redirect( base_url_api.'login/transport', 'refresh');

    }
   
}
