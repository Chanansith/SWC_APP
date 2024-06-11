<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fix_model extends CI_Model
{
    function fixListingCount($id,$searchText = '')
    {
        $this->db->select('id');
        $this->db->from('fix_car');
        // if (!empty($searchText)) {
        //     $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
        //                     OR  last_name  LIKE '%" . $searchText . "%'
        //                     OR  id_card  LIKE '%" . $searchText . "%'
        //                     OR  issue_date  LIKE '%" . $searchText . "%'
        //                     OR  exp_date  LIKE '%" . $searchText . "%'
        //                     OR  id_card_farmer  LIKE '%" . $searchText . "%'
        //                     OR  birthdate  LIKE '%" . $searchText . "%'
        //                     OR  phone  LIKE '%" . $searchText . "%')";

        //     $this->db->where($likeCriteria);
        // }
        $this->db->where('is_delete', 0);
        $this->db->where('carno', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return count($query->result());
    }
    function fixListing($id,$searchText = '', $page = 0, $segment = 0){
        $this->db->select('id,sum,date,create_by');
        $this->db->from('fix_car');
        // if (!empty($searchText)) {
        //     $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
        //                     OR  last_name  LIKE '%" . $searchText . "%'
        //                     OR  id_card  LIKE '%" . $searchText . "%'
        //                     OR  issue_date  LIKE '%" . $searchText . "%'
        //                     OR  exp_date  LIKE '%" . $searchText . "%'
        //                     OR  id_card_farmer  LIKE '%" . $searchText . "%'
        //                     OR  birthdate  LIKE '%" . $searchText . "%'
        //                     OR  phone  LIKE '%" . $searchText . "%')";
        //     $this->db->where($likeCriteria);
        // }
        $this->db->where('is_delete', 0);
        $this->db->where('carno', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getfixIn($id){
        $this->db->select('*');
        $this->db->from('fix_car_in');
        $this->db->where('fix_car_id', $id);
        $this->db->where('is_delete', 0);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getfixOut($id){
        $this->db->select('*');
        $this->db->from('fix_car_out');
        $this->db->where('fix_car_id', $id);
        $this->db->where('is_delete', 0);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewFix($data){
        $this->db->trans_start();
        $this->db->insert('fix_car', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function addNewFix_in($data){
        $this->db->trans_start();
        $this->db->insert('fix_car_in', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function addNewFix_out($data){
        $this->db->trans_start();
        $this->db->insert('fix_car_out', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function editOldFix_in($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('fix_car_in', $data);

        return TRUE;
    }
    function editOldFix_out($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('fix_car_out', $data);

        return TRUE;
    }
    function removeFix($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('fix_car', $data);

        return TRUE;
    }
    function removeFixIn($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('fix_car_in', $data);

        return TRUE;
    }
    function removeFixOut($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('fix_car_out', $data);

        return TRUE;
    }
}