<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
    function newsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_news ');
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

    function newsListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('tbl_news');
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
    
    function addNewNews($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_news', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    function getNews($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_news');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function editOldNews($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_news', $data);
        
        return TRUE;
    }
    function deleteNews($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_news', $data);
        
        return $this->db->affected_rows();
    }
}