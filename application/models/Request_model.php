<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Request_model extends CI_Model
{
    function ContractListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('contracts ');
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

    function ContractListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('contracts');
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

    public function getAutoContractCode($userid){
        $dateString = date('Ymd'); //Generate a datestring.
            $branchNumber = $userid; //Get the branch number somehow.


            $this->db->select(' id ');
            $this->db->from('contracts');
          
            $this->db->where('user_id', $userid);
            $query = $this->db->get();
            $result = $query->result();      
            $count_row = count($query->result());  //You will query the last receipt in your database 
            //and get the last $receiptNumber for that branch and add 1 to it.;

           
            $receiptNumber = $count_row + 1;
            $padded_num = str_pad($branchNumber, 4, '0', STR_PAD_LEFT);
            $padded_auto = str_pad($receiptNumber, 4, '0', STR_PAD_LEFT);
         
            return 'HN-'.$padded_num . '-' . $dateString . '-' . $padded_auto;
    }
    
    function create($data)
    {
    
        $this->db->insert('contracts', $data);
        
        $insert_id = $this->db->insert_id();
        
     
        
        return $insert_id;
    }

    function getRequest($id)
    {
        $this->db->select('t1.*,t2.companyname,t4.disposal_name');
        $this->db->from('transport_request t1');
        $this->db->join('users t2', 't1.request_by = t2.id');
        $this->db->join('contracts t3','t1.id=t3.user_id');
        $this->db->join('disposal t4', 't3.disposalid = t4.id');
        $this->db->where('t1.assign_to', $id);
       

        $query = $this->db->get();
        
        return $query->result();
    }
    
    function getContractByUser($id)
    {
        $this->db->select('*');
        $this->db->from('contracts');
    
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getContractByDisposal($id)
    {
        $this->db->select('t1.*,t2.companyname');
        $this->db->from('contracts t1');
        $this->db->join('users t2', 't1.user_id = t2.id');
    
        $this->db->where('t1.disposalid', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getContractByTransport($id)
    {
        $this->db->select('t1.*,t2.companyname');
        $this->db->from('contracts t1');
        $this->db->join('users t2', 't1.user_id = t2.id');
    
        $this->db->where('t1.transportid', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function edit($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('contracts', $data);
        
        return TRUE;
    }
    function delete($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('contracts', $data);
        
        return $this->db->affected_rows();
    }
}