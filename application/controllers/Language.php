<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Language extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('language_model');
        $this->isLoggedIn();
    }
    public function language()
    {
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;

        $data['languageRecords'] = $this->language_model->languageListing($searchText);

        $this->global['pageTitle'] = 'Language';

        $this->loadViews("language/index", $this->global, $data, NULL);
    }
    function editLanguage($id){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Edit Language';
            $data['Language'] = $this->language_model->getLanguage($id);
            $data['id'] = $id;
            $this->loadViews("language/editOld", $this->global, $data, NULL);
        }
    }
    function editOldLanguage(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $id = $this->input->post('id');
            // $this->form_validation->set_rules('image', 'Image', 'trim|required|xss_clean');
            $this->form_validation->set_rules('english', 'English', 'trim|required|xss_clean');
            $this->form_validation->set_rules('thai', 'Thai', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lao', 'Lao', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->editLanguage($id);
            } else {
                $english = $this->input->post('english');
                $thai = $this->input->post('thai');
                $lao = $this->input->post('lao');

                $data = array(
                    'en' => $english,
                    'th' => $thai,
                    'lao' => $lao,
                );

                $result = $this->language_model->editOldLanguage($data,$id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Edit Language successfully');
                } else {
                    $this->session->set_flashdata('error', 'Edit Language failed');
                }

                redirect('language');
            }
        }
    }
    function changelanguage(){
        $language = $this->input->post('language');
        $sessionArray = array('language'=>$language);
        $this->session->set_userdata($sessionArray);
        $data['status'] = true;
        echo json_encode($data);
    }
}