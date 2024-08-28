<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Disposal_model extends CI_Model
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

    function transportListing($id)
    {
        $this->db->select('*');
        // $this->db->select('t1.id,t1.vat,t2.id as condition_list_id,t2.subject,t2.transport,t2.transfer_date,t2.create_by,t2.update_by');
        $this->db->from('transport t1');
       
    
        $this->db->where('t1.carno', $id);
      
    
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
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
    function conditionList($id)
    {
        $this->db->select('t1.subject,t1.disposal,t1.transfer_date,t1.id,t1.disposal_id,t1.create_by,t1.vat');
        $this->db->from('disposal_condition_list t1');

        $this->db->where('t1.disposal_id', $id);
        $this->db->where('t1.is_delete', 0);
        // $this->db->order_by('t1.id', 'desc');
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
        $this->db->select('t1.*');
        $this->db->from('transport_item t1');
        $this->db->join('contracts t2', 't1.contract_id = t2.id');
        $this->db->where('t2.disposalid ', $id);
        //Transport user id
        //$this->db->where('tran_by ', $id);
       
        $query = $this->db->get();

        return $query->result();
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
