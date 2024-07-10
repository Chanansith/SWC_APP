<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    
    
    function create($data)
    {
    
        $this->db->insert('payments', $data);
        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    function getPayment($id)
    {
        $this->db->select('*');
        $this->db->from('payments');
    
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getPaymentByContract($contract_id)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('contract_id', $contract_id);
        $query = $this->db->get();
        
        return $query->result();
    }

    
    function getPaymentByUser($id)
    {
        $this->db->select('*');
        $this->db->from('payments');
    
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
 
    function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('payments', $data);
        
        return TRUE;
    }
    function delete($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
        
        return $this->db->affected_rows();
    }
}