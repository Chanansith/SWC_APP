<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Provinces extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('province_model');
        
      
    }

    function amphures($id){
        $data = $this->province_model->getAmphures($id);
        echo json_encode($data);
    }
   
    function districts($id){
        $data = $this->province_model->getDistricts($id);
        echo json_encode($data);
    }
    function mainlocation($province){
        $search=urldecode($province);
        $data = $this->province_model->getMainLocation($search);
        echo json_encode($data);
    }
    function mainlocation_test($province){
        $data = $this->province_model->getMainLocation($province);
        echo json_encode($data);
    }
}