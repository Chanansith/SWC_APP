<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transport_model extends CI_Model
{
    function transportListingCount($id, $searchText = '')
    {
        $this->db->select('t1.id,t1.vat,t1.create_by');
        // $this->db->select('t1.id,t1.vat,t2.id as condition_list_id,t2.subject,t2.transport,t2.transfer_date,t2.create_by,t2.update_by');
        $this->db->from('transport t1');
        // $this->db->join("transport_condition_list t2", "t2.transport_id=t1.id","left");
        // if(!empty($searchText)) {
        //     $likeCriteria = "(id   LIKE '%".$searchText."%'
        //                     OR  transporttype   LIKE '%".$searchText."%'
        //                     )";
        //     $this->db->where($likeCriteria);
        // }
        $this->db->where('t1.carno', $id);
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        return count($query->result());
    }

    function create($data)
    {
    
        $this->db->insert('transport_item', $data);
        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }

  
    function getForDropdown()
    {
        $this->db->select('id,full_name');
        $this->db->from('transport_user');

   
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
  
    function getDataByItemID($id)
    {
        $this->db->select('*');
        $this->db->from('transport_item');
        //Transport user id
        $this->db->where('id ', $id);
        $query = $this->db->get();

        return $query->result();
    }


    function getDataByID($id)
    {
        $this->db->select('t1.*,t3.companyname,t4.full_name');
        $this->db->from('transport_item t1');
        $this->db->join('contracts t2', 't1.contract_id = t2.id');
        $this->db->join('users t3', 't2.user_id =t3.id');
        $this->db->join('transport_user t4', 't1.tran_by = t4.id');
       
        //Transport user id
        $this->db->where('t1.tran_by ', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function updateTransport($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('transport_item', $data);
        
        return TRUE;
    }

    function getData()
    {
        $this->db->select('t1.*,t3.companyname,t4.full_name');
        $this->db->from('transport_item t1');
        $this->db->join('contracts t2', 't1.contract_id = t2.id');
        $this->db->join('users t3', 't2.user_id =t3.id');
        $this->db->join('transport_user t4', 't1.tran_by = t4.id');
       
        $query = $this->db->get();

        return $query->result();
    }
    function deletetransport($id, $data)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport_item', $data);

        return $this->db->affected_rows();
    }

  
 
   

        function addTransportUser($userInfo)
    {
    
        $this->db->insert('transport_user', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
    
        return $insert_id;
    }
    
}
