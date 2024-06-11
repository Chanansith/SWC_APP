<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends CI_Model
{
    function getAdminCount($searchText = ''){
        $this->db->select('t1.*');
        $this->db->from('admin t1');
        if (!empty($searchText)) {
            $likeCriteria = "(t1.username  LIKE '%" . $searchText . "%'
                            OR  t1.role  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();

        return count($query->result());
    }
    function getAdmin($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('t1.*');
        $this->db->from('admin t1');
        if (!empty($searchText)) {
            $likeCriteria = "(t1.username  LIKE '%" . $searchText . "%'
                            OR  t1.role  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getAdminById($username){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $query = $this->db->get();
        
        return $query->result();
    }
    function addNewPermission($data){
        $this->db->trans_start();
        $this->db->insert('admin', $data);

        // $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return 1;
    }
    function editOldPermission($data, $id)
    {
        $this->db->where('username', $id);
        $this->db->update('admin', $data);

        return TRUE;
    }
}