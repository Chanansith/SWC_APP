<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Language_model extends CI_Model
{


    function languageListing($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('language');
        if(!empty($searchText)) {
            $likeCriteria = "(code  LIKE '%".$searchText."%'
                            OR  en  LIKE '%".$searchText."%'
                            OR  th  LIKE '%".$searchText."%'
                            OR  lao  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function getheader(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where('id >=', 1);
        $this->db->where('id <=', 6);
        $query = $this->db->get();
        return $query->result();
    }
    function getheadercontact(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where('id >=', 7);
        $this->db->where('id <=', 12);
        $query = $this->db->get();
        return $query->result();
    }
    function getheadercategory(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1, 13, 14));
        $query = $this->db->get();
        return $query->result();
    }
    function getheadersubcategory(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1, 13, 14));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderplants(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1, 13, 14));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderproduct_name(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,2, 13, 14,15,16,17,18,19));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderfarmer(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,2,9,12, 20, 21,22,23,24,25,26,27,28,29,30));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderfarm(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,2,12,13,14,31,32));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderproduction(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,33,34,35,36,37,38,39,40,41,42));
        $query = $this->db->get();
        return $query->result();
    } 
    function getheadercultivation(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,2,43,44,45));
        $query = $this->db->get();
        return $query->result();
    } 
    function getheadercustomer(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,12,20,23,24,27,28,46,47,48));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderorderaddedit(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,34,49,50,51,52,53,54));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderorder(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,49,50,51,52,53,54));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderorderItem(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,33,55,56,57));
        $query = $this->db->get();
        return $query->result();
    }
    function getheadercontactrec(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,2,58,49,23,12,59,60,61,62,63,64,65));
        $query = $this->db->get();
        return $query->result();
    }
    function getLanguage($id){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    function editOldLanguage($data,$id){
        $this->db->where('id', $id);
        $this->db->update('language', $data);

        return TRUE;
    }
    function getheadersearch(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(33,37,38,39,40,66));
        $query = $this->db->get();
        return $query->result();
    }
    function getHeaderReport_sign_search(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,49,59,61,67));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderagriculture(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(1,23,67));
        $query = $this->db->get();
        return $query->result();
    }
    function headersearchcustomer(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(34,49,67));
        $query = $this->db->get();
        return $query->result();
    }
    function getheaderreportorder(){
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where_in('id', array(50,67,68));
        $query = $this->db->get();
        return $query->result();
    }
}