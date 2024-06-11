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
    function gettransportById($id)
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
        $this->db->select('id,full_name');
        $this->db->from('transport_user');

   
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function conditionList($id)
    {
        $this->db->select('t1.subject,t1.transport,t1.transfer_date,t1.id,t1.transport_id,t1.create_by,t1.vat');
        $this->db->from('transport_condition_list t1');

        $this->db->where('t1.transport_id', $id);
        $this->db->where('t1.is_delete', 0);
        // $this->db->order_by('t1.id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewtransportCar($data)
    {
        $this->db->trans_start();
        $this->db->insert('transport', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function addNewCondition($data)
    {
        $this->db->trans_start();
        $this->db->insert('transport_condition_list', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function addNewCondition_transport($data)
    {
        $this->db->trans_start();
        $this->db->insert('condition_transport', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getCondition_transport($id){
        $this->db->select('*');
        $this->db->from('condition_transport');

        $this->db->where('id ', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldCondition_transport($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('condition_transport', $data);

        return TRUE;
    }
    function getCustomer($id)
    {
        $this->db->select('*');
        $this->db->from('transports');

        $this->db->where('id ', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldtransportCar($data, $id)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport', $data);

        return TRUE;
    }
    function editOldCondition($data, $id)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport_condition_list', $data);

        return TRUE;
    }
    function deleteCondition($id, $data)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport_condition_list', $data);

        return $this->db->affected_rows();
    }
    function deleteCondition_transport($id,$data){
        $this->db->where('id ', $id);
        $this->db->update('condition_transport', $data);

        return $this->db->affected_rows();
    }
    function deletetransport($id, $data)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport', $data);

        return $this->db->affected_rows();
    }
    function condition_transportListing($id){
        $this->db->select('t1.*');
        $this->db->from('condition_transport t1');
        $this->db->where('t1.transport_id', $id);
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function condition_transportListingCount($id){
        $this->db->select('t1.*');
        $this->db->from('condition_transport t1');
        $this->db->where('t1.transport_id', $id);
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        return count($query->result());
    }
    function regis_departListing($id){
        $this->db->select('t1.*');
        $this->db->from('transport_regis_depart t1');
        $this->db->where('t1.transport_id', $id);
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function regis_departListingCount($id){
        $this->db->select('t1.*');
        $this->db->from('transport_regis_depart t1');
        $this->db->where('t1.transport_id', $id);
        $this->db->where('t1.is_delete', 0);
        
        $query = $this->db->get();

        return count($query->result());
    }
    function addNewRegis_depart($data){
        $this->db->trans_start();
        $this->db->insert('transport_regis_depart', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function editOldRegis_depart($data, $id)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport_regis_depart', $data);

        return TRUE;
    }
    function deleteRegis_depart($id, $data)
    {
        $this->db->where('id ', $id);
        $this->db->update('transport_regis_depart', $data);

        return $this->db->affected_rows();
    }
    function getRegis_depart($id){
        $this->db->select('*');
        $this->db->from('transport_regis_depart');

        $this->db->where('id ', $id);
        $query = $this->db->get();

        return $query->result();
    }
}
