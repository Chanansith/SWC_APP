<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Disposal_model extends CI_Model
{
    
 
    function getById($id)
    {
        $this->db->select('t1.vat');
        $this->db->from('transport t1');

        $this->db->where('t1.id', $id);
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        $result = $query->row_array();
        return $result;
    }
    function getForDropdown()
    {
        $this->db->select('id,disposal_name');
        $this->db->from('disposal');

   
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    
    function addNew($data)
    {
       
        $this->db->insert('disposal', $data);

        $insert_id = $this->db->insert_id();

     
        return $insert_id;
    }
    function addContract($data)
    {
    
        $this->db->insert('disposal_contracts', $data);
        
        $insert_id = $this->db->insert_id();
        
    
        return $insert_id;
    }
    function getMyTransport($id)
    {
        $this->db->select('t1.*,t3.companyname,t4.full_name');
        $this->db->from('transport_item t1');
       
        $this->db->join('contracts t2', 't1.contract_id = t2.id');
        $this->db->join('users t3', 't2.user_id =t3.id');
        $this->db->join('transport_user t4', 't1.tran_by = t4.id');
        $this->db->where('t2.disposalid ', $id);
        //Transport user id
        //$this->db->where('tran_by ', $id);
       
        $query = $this->db->get();

        return $query->result();
    }

    function countTransport($id, $approve_status)
    {
        $this->db->select('t1.id');
        $this->db->from('transport_item t1');
        $this->db->join('contracts t2', 't1.contract_id = t2.id');
        $this->db->where('t2.disposalid ', $id);
        if ($approve_status>0){
            $this->db->where('t1.approve_status ', $approve_status);
        }
       
        $query = $this->db->get();
      
        return count($query->result());
    }


    function getContract($id)
    {
        $this->db->select('*');
        $this->db->from('disposal_contracts');
    
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getMonitoring($id)
    {
        $this->db->select('*');
        $this->db->from('monitoring');
    
        $this->db->where('disposal_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
  
    function updateMonitoring($data, $id)
    {
        $this->db->where('disposal_id', $id);
        $this->db->update('monitoring', $data);
        
        return TRUE;
    }
    function updateDaily($imw_status_daily, $id)
    {
        $this->db->set('imw_status_daily', 'imw_status_daily+' . (int)$imw_status_daily, FALSE);
        $this->db->where('disposal_id', $id);
        $this->db->update('monitoring');
        
        return TRUE;
    }
    function getContractByDisposal($id)
    {
        $this->db->select('t1.*,t2.companyname');
        $this->db->from('disposal_contracts t1');
        $this->db->join('transport_user t2', 't1.transportid = t2.id');
    
        $this->db->where('t1.disposalid', $id);
        $query = $this->db->get();
        
        return $query->result();
    }


 
 
}
