<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Login extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('province_model');
        $this->load->model('log_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    public function hn()
    {
        $this->load->view('login');
    }
    public function disposal()
    {
        $this->load->view('disposal/disposallogin');
    }
    public function transport()
    {
        $this->load->view('transport/translogin');
    }

    public function testecho(){
        echo "test echo";
    }
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('index.php/dashboard');
        }
    }
    
    function loginMe(){
        echo "success";
    }

    /**
     * This function used to logged in user
     */
    public function checkLogin()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Phone', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect(base_url_api.'login/hn');
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginMe($username, $password);
            
            if(count($result) > 0)
            {

                
                foreach ($result as $res)
                {
                    $sessionArray = array('userId'=>$res->id,                    
                                            'role'=>"hospital",
                                            'roleText'=>"",
                                            'name'=>$res->companyname	,
                                            'code'=>$res->code,
                                            'isLoggedIn' => TRUE
                                    );
                                    
                    $this->session->set_userdata($sessionArray);
                    unset($_SESSION["error"]);
                    //echo "success";
                    
                }
                
                //redirect('index.php/dashboard');
              
                redirect( base_url_api.'dashboard', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
              
                 redirect(base_url_api.'login/hn');
            }
        }
    }

    public function checkDisposal()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Phone', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect(base_url_api. 'login/disposal');
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginDisposal($username, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $sessionArray = array('userId'=>$res->id,                    
                                            'role'=>"disposal",
                                            'roleText'=>"",
                                            'name'=>$res->disposal_name,
                                            'code'=>$res->id,
                                            'isLoggedIn' => TRUE
                                    );
                                    
                    $this->session->set_userdata($sessionArray);
                    unset($_SESSION["error"]);
                    //redirect( base_url_api.'disposal', 'refresh');                
                 }
                   

                       redirect( base_url_api.'disposal', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
              
                 redirect(base_url_api. 'login/disposal');
            }
        }
    }


    public function checkTransport()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Phone', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect(base_url_api.'login/transport');
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginTransport($username, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $sessionArray = array('userId'=>$res->id,                    
                                            'role'=>"transport",
                                            'roleText'=>"",
                                            'name'=>$res->companyname	,
                                            'code'=>$res->code,
                                            'isLoggedIn' => TRUE
                                    );
                                    
                    $this->session->set_userdata($sessionArray);
                    
                    unset($_SESSION["error"]);
              
                    //echo "success";
                  
                }
                redirect( base_url_api.'transport', 'refresh');
               // echo "<a href=".base_url()."index.php/transport class='btn btn-success'>ถัดไป</a>";
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
              
                 redirect(base_url_api.'login/transport');
            }
        }
    }




    function addNew()
    {
        
          
        $data["title"]="index";
        $this->global["name"]="guess";
        $this->global["pageTitle"]="home";
        $data["provinces"]=$this->province_model->getProvinces();
       
        $this->loadViewsNoHeader("addNew", $this->global, $data, NULL);
        
    }

  
    function addNewShipDocument($userid)
    {
        
          
        $data["title"]="index";
        $this->global["name"]="shipping";
        $this->global["pageTitle"]="home";
    
        $this->loadViewsNoHeader("uploadshipfile", $this->global, $data, NULL);
        
    }

    function sendMail($body){
       
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'swc.centerlogistic@gmail.com',
            'smtp_pass' => 'Id@123zxcv',
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('swc.centerlogistic@gmail.com', 'SWC Admin');
        $this->email->to('thaismartprogrammer@gmail.com');
        $this->email->subject('SWC Register');
        $this->email->message($body);
   
    if ($this->email->send()) {
        echo 'Email sent!';
    } else {
        echo $this->email->print_debugger();
    }

        
    }
    function getPassword(){
        return rand(123456,987654);
    }
    function registersuccess($userid)
    {
        
          
        $data["title"]="index";
        $this->global["name"]="shipping";
        $data["currentpassword"]="";
        $this->global["pageTitle"]="home";
    
        $this->loadViewsNoHeader("addNewSuccess", $this->global, $data, NULL);
        
    }
   
    function saveUploadShipDoc()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('companyname','ชื่อสถานประกอบการ','required|max_length[255]');
            
            
           

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {

                $mobile = $this->input->post('mobile_no');
                $users_exists = $this->user_model->checkUserExists($mobile);
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
                    $tel = $this->input->post('tel_no');
                    
                    $email = $this->input->post('email');
                    $lat = $this->input->post('lat');
                    $lng = $this->input->post('lng');
                    $main_location = $this->input->post('main_location');
                    $password=$this->getPassword();
              
                    $userInfo = array('email'=>$email,  'companyname'=> $companyname,'code'=>$code,'hascode'=>$hascode,
                                        'address_no'=>$address_no,'moo'=>$moo,
                                         'mobile_no'=>$mobile,'cate_id'=>$cate_id, 'sub_cate_id'=>$sub_cate_id, 
                                         'provinceid'=>$provinceid,'districtid'=>$districtid,'amphurid'=>$amphurid,
                                         'lat'=>$lat,'lng'=>$lng,'main_location'=>$main_location,
                                         'pass'=>$password,
                                         'createon'=>date('Y-m-d H:i:s'));
                    
           
              

                    $result = $this->user_model->addNewUser($userInfo);
                    
                    if($result > 0)
                    {
                        $this->session->set_flashdata('success', 'สมัครสมาชิกเรียบร้อย');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'พบข้อผิดพลาด');
                    }
                    
                    redirect(base_url_api.'register');
                }else{
                    //$this->session->set_flashdata('error', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
                    $this->form_validation->set_message('is_unique', 'มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว');
                    $this->addNew();
                    //echo "มีผู้ใช้เคยเบอร์โทรศัพท์นี้สมัครอยู่แล้ว";
            }
        }
        
    }

    
    function upload_ship_image($imageFile)
    {
        $config['upload_path']          = './assets/shipimage';
        $config['file_name']            =  $imageFile.uniqid();
        $config['allowed_types']        = 'jpeg|jpg|png|pdf';
        $config['max_size']             = 5048; //2MB

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

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $this->load->view('forgotPassword');
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email|xss_clean');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->input->post('login_email');
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('/forgotPassword');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect("/index.php/login/hn");
        }
    }
    
    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);

            redirect("/index.php/login/hn");
        }
    }


}

?>