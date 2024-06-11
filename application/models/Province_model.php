<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Province_model extends CI_Model
{
    function bannerListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_banner ');
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

    function getProvinces($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('provinces');
        if(!empty($searchText)) {
            $likeCriteria = "(code  LIKE '%".$searchText."%'
                            OR  name_th  LIKE '%".$searchText."%'
                          )";
            $this->db->where($likeCriteria);
        }
     
      
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function getMainLocation($province_name)
    {
        $this->db->select('*');
        $this->db->from('main_location');
        // if(!empty($searchText)) {
        //     $likeCriteria = "(code  LIKE '%".$searchText."%'
        //                     OR  location_name  LIKE '%".$searchText."%'
        //                   )";
        //     $this->db->where($likeCriteria);
        // }
        $this->db->where(" province   LIKE '%".$province_name."%' ");
      
     
        $query = $this->db->get();
       // print_r($this->db->last_query());
        $result = $query->result();        
        return $result;
    }
    function getAmphures($province_id)
    {
        $this->db->select('*');
        $this->db->from('amphures');
      
        $this->db->where('province_id', $province_id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getDistricts($amphure_id)
    {
        $this->db->select('*');
        $this->db->from('districts');
      
        $this->db->where('amphure_id', $amphure_id);
        $query = $this->db->get();
        
        return $query->result();
    }
}