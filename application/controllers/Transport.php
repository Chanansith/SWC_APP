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
        $this->load->model('log_model');
    }
    public function index()
    {
        $this->not_logged_in_transport();
        $data["summary"]=[];
        $this->loadTransportViews('transport/transdasboard', $this->global, $data, NULL);
        
    }
    function saveNewShipUser()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fullname','ชื่อนามสกุล','required|max_length[255]');
            $this->form_validation->set_rules('mobile_no','เบอร์โทรศัพท์มือถือ','required|max_length[20]');
         
            


            if($this->form_validation->run() == FALSE)
            {
                $this->addNewShipUser();
            }
            else
            {
                $mobile = $this->input->post('mobile_no');
                $users_exists = $this->user_model->checkUserExists($mobile);
                if(count($users_exists)==0){

                 $code = $this->input->post('code');
                 $hascode = $this->input->post('hascode');
                 $companyname = $this->input->post('companyname');
                 $title = $this->input->post('title');
                 $fullname = $this->input->post('fullname');
                 $cate_id = $this->input->post('cate_id');
                 $sub_cate_id = $this->input->post('sub_cate_id');
                 $address_no = $this->input->post('address_no');
                 $moo = $this->input->post('sub_cate_id');
                 $zipcode = $this->input->post('zipcode');
                 $provinceid = $this->input->post('province');
                 $districtid = $this->input->post('distric');
                 $amphurid = $this->input->post('amphure');
                 $tel = $this->input->post('tel_no');
                 $mobile = $this->input->post('mobile_no');
                 $email = $this->input->post('email');
                 $lat = $this->input->post('lat');
                 $lng = $this->input->post('lng');
                 $main_location = $this->input->post('main_location');
                 $password=$this->getPassword();
                 $registerno = $this->input->post('registerno');
                 
                // // $secret_key = $this->input->post('secret_key');
                // // $myreferral = $this->input->post('myreferral');
                    $userInfo = array('email'=>$email,  'companyname'=> $companyname,'code'=>$code,'hascode'=>$hascode,
                                         'title'=>$title,'fullname'=>$fullname,
                                        'address_no'=>$address_no,'moo'=>$moo,
                                         'mobile_no'=>$mobile,
                                         'provinceid'=>$provinceid,'districtid'=>$districtid,'amphurid'=>$amphurid,
                                         'lat'=>$lat,'lng'=>$lng,'main_location'=>$main_location,
                                         'registerno'=>$registerno,'pass'=>$password,
                                         'createon'=>date('Y-m-d H:i:s'));
                    
           
              

                    $result = $this->user_model->addNewShipUser($userInfo);

                    //upload file after
                    
                    if($result > 0)
                    {
                        $this->session->set_flashdata('success', 'สมัครสมาชิกเรียบร้อย');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'พบข้อผิดพลาด');
                    }
                    
                    redirect('index.php/registershipping');
                }else {
                   // $this->session->set_flashdata('error', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
                    $this->form_validation->set_message('is_unique', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
                    $this->addNewShipUser();
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
