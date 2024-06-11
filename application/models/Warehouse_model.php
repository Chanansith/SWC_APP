<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse_model extends CI_Model
{
    function warehouseListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('ProductCategory');
        if(!empty($searchText)) {
            $likeCriteria = "(category_name_la  LIKE '%".$searchText."%'
                            OR  category_name_en  LIKE '%".$searchText."%'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $query = $this->db->get();
        
        return count($query->result());
    }
    function warehouseListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('ProductCategory');
        if (!empty($searchText)) {
            $likeCriteria = "(category_name_la  LIKE '%" . $searchText . "%'
                            OR  category_name_en  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}