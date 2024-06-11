<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Permission extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('permission_model');
        $this->isLoggedIn();
    }
    function index()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->permission_model->getAdminCount($searchText);
            $returns = $this->paginationCompress("permission/", $count, 15);
            $data['adminRecords'] = $this->permission_model->getAdmin($searchText, $returns["page"], $returns["segment"]);
            $data['segment'] = $returns["segment"];
            $data['page'] = $returns["page"];
            $this->global['pageTitle'] = 'Permission';
            $this->loadViews("permission/index", $this->global, $data, NULL);
        }
    }
    function addPermission()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Permission';
            $this->loadViews("permission/addNewPermission", $this->global, NULL, NULL);
        }
    }
    function addNewPermission()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Permission';
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $role = $this->input->post('role');
            $data = array(
                'username' => $username,
                'pass' => $password,
                'userstatus' => 1,
                'role' => $role
            );
            $check = $this->permission_model->getAdminById($username);
            if (count($check) === 0) {
                $result = $this->permission_model->addNewPermission($data);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Permission created successfully');
                    redirect('permission');
                } else {
                    $this->session->set_flashdata('error', 'Permission creation failed');
                    redirect('addPermission');
                }
            } else {
                $this->session->set_flashdata('error', 'Permission check failed');
                redirect('addPermission');
            }
        }
    }
    function editPermission($username)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Permission';
            $data['adminRecords'] = $this->permission_model->getAdminById($username);
            $this->loadViews("permission/editOldPermission", $this->global, $data, NULL);
        }
    }
    function editOldPermission(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Permission';
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $role = $this->input->post('role');
            $data = array(
                'pass' => $password,
                'role' => $role
            );
            $result = $this->permission_model->editOldPermission($data,$username);
            if ($result > 0) {
                $this->session->set_flashdata('success', 'New Permission created successfully');
                redirect('permission');
            } else {
                $this->session->set_flashdata('error', 'Permission creation failed');
                redirect('editPermission');
            }
        }
    }
}
