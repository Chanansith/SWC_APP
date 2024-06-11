<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class WhyUs extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('whyus_model');
        $this->load->model('language_model');
        $this->isLoggedIn();
    }
    public function whyusListing()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');
            $count = $this->whyus_model->whyusListingCount($searchText);
            $returns = $this->paginationCompress("whyusListing/", $count, 15);

            $data['whyusRecords'] = $this->whyus_model->whyusListing($searchText, $returns["page"], $returns["segment"]);
            $data['header'] = $this->language_model->getheader();
            $data['language'] = $this->language;
            $this->global['pageTitle'] = 'WhyUs';

            $this->loadViews("whyus/index", $this->global, $data, NULL);
        }
    }
    function addWhyUs()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Add WhyUs';
            $data['header'] = $this->language_model->getheader();
            $data['language'] = $this->language;
            $this->loadViews("whyus/addNew", $this->global, $data, NULL);
        }
    }
    function addNewWhyUs()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            // $this->form_validation->set_rules('image', 'Image', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title_eng', 'Title Eng', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title_lao', 'Title Lao', 'trim|required|xss_clean');
            $this->form_validation->set_rules('detail_eng', 'Detail Eng', 'trim|required|xss_clean');
            $this->form_validation->set_rules('detail_lao', 'Detail Lao', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->addWhyUs();
            } else {
                $title_eng = $this->input->post('title_eng');
                $title_lao = $this->input->post('title_lao');
                $detail_eng = $this->input->post('detail_eng');
                $detail_lao = $this->input->post('detail_lao');

                $data = array(
                    'title_lao' => $title_lao,
                    'title_eng' => $title_eng,
                    'detail_lao' => $detail_lao,
                    'detail_eng' => $detail_eng,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:s')
                );
                if (!empty($_FILES['image']['name'])) {
                    $img_data = $this->do_upload_image('image');
                    $data['image'] = 'assets/imageWhyUs/' . $img_data['upload_data']['file_name'];
                    // $data['m_image'] = $_FILES['m_image']['name'];
                }

                $result = $this->whyus_model->addNewWhyUs($data);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New WhyUs created successfully');
                } else {
                    $this->session->set_flashdata('error', 'WhyUs creation failed');
                }

                redirect('whyUs');
            }
        }
    }
    function editWhyUs($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Edit WhyUs';
            $data['WhyUs'] = $this->whyus_model->getWhyUs($id); 
            $data['header'] = $this->language_model->getheader();
            $data['language'] = $this->language;
            $this->loadViews("whyus/editOld", $this->global, $data, NULL);
        }
    }
    function editOldWhyUs(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $id = $this->input->post('id');
            // $this->form_validation->set_rules('image', 'Image', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title_eng', 'Title Eng', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title_lao', 'Title Lao', 'trim|required|xss_clean');
            $this->form_validation->set_rules('detail_eng', 'Detail Eng', 'trim|required|xss_clean');
            $this->form_validation->set_rules('detail_lao', 'Detail Lao', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->editWhyUs($id);
            } else {
                $title_eng = $this->input->post('title_eng');
                $title_lao = $this->input->post('title_lao');
                $detail_eng = $this->input->post('detail_eng');
                $detail_lao = $this->input->post('detail_lao');

                $data = array(
                    'title_lao' => $title_lao,
                    'title_eng' => $title_eng,
                    'detail_lao' => $detail_lao,
                    'detail_eng' => $detail_eng,
                    'updatedBy'=>$this->vendorId, 
                    'updatedDtm'=>date('Y-m-d H:i:s')
                );
                if (!empty($_FILES['image']['name'])) {
                    $img_data = $this->do_upload_image('image');
                    $data['image'] = 'assets/imageWhyUs/' . $img_data['upload_data']['file_name'];
                    // $data['m_image'] = $_FILES['m_image']['name'];
                }

                $result = $this->whyus_model->editOldWhyUs($data,$id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Edit WhyUs successfully');
                } else {
                    $this->session->set_flashdata('error', 'Edit WhyUs failed');
                }

                redirect('whyUs');
            }
        }
    }
    
    function deleteWhyUs()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {   
            $id = $this->input->post('id');
            $data = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->whyus_model->deleteWhyUs($id, $data);
            
            // echo json_encode($result);
            $data["status"]=false;
            if($result > 0)
            {   
                $data["status"]=true;
                $this->session->set_flashdata('success', 'Delete WhyUs successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Delete WhyUs failed');
            }
            echo json_encode($data);
            // redirect('business','refresh');
        }
    }
    function do_upload_image($imageFile)
    {
        $config['upload_path']          = './assets/imageWhyUs';
        $config['file_name']            =  uniqid();
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
