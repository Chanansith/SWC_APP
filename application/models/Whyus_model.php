<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Whyus_model extends CI_Model
{
    function whyusListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_whyus ');
        if(!empty($searchText)) {
            $likeCriteria = "(title_lao  LIKE '%".$searchText."%'
                            OR  title_eng  LIKE '%".$searchText."%'
                            OR  detail_lao  LIKE '%".$searchText."%'
                            OR  detail_eng  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return count($query->result());
    }

    function whyusListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('tbl_whyus');
        if(!empty($searchText)) {
            $likeCriteria = "(title_lao  LIKE '%".$searchText."%'
                            OR  title_eng  LIKE '%".$searchText."%'
                            OR  detail_lao  LIKE '%".$searchText."%'
                            OR  detail_eng  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function addNewWhyUs($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_whyus', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    function getWhyUs($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_whyus');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function editOldWhyUs($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_whyus', $data);
        
        return TRUE;
    }
    function deleteWhyUs($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_whyus', $data);
        
        return $this->db->affected_rows();
    }
}