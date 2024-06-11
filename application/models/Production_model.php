<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Production_model extends CI_Model
{
    function productionListingCount($searchText = '')
    {
        $this->db->select('t1.*,t2.product_name_en,t2.product_name_la,t3.first_name,t3.last_name,t4.farm_name_la,t4.farm_name_en');
        $this->db->from('Production t1');
        $this->db->join('ProductName t2', 't1.product_id = t2.product_id','left');
        $this->db->join('Farmer t3', 't1.farmer_id  = t3.farmer_id','left');
        $this->db->join('Farm t4', 't1.farm_id  = t4.farm_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(t1.planting_date  LIKE '%" . $searchText . "%'
                            OR  t1.harvest_date_befor  LIKE '%" . $searchText . "%'
                            OR  t1.yield_befor  LIKE '%" . $searchText . "%'
                            OR  t1.yield_affter  LIKE '%" . $searchText . "%'
                            OR  t1.harvest_date_affter  LIKE '%" . $searchText . "%'
                            OR  t3.first_name  LIKE '%" . $searchText . "%'
                            OR  t3.last_name  LIKE '%" . $searchText . "%'
                            OR  t4.farm_name_la  LIKE '%" . $searchText . "%'
                            OR  t4.farm_name_en  LIKE '%" . $searchText . "%'
                            OR  t2.product_name_en  LIKE '%" . $searchText . "%'
                            OR  t2.product_name_la  LIKE '%" . $searchText . "%'
                            )";

            $this->db->where($likeCriteria);
        }
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by('t1.production_id', 'desc');
        $query = $this->db->get();

        return count($query->result());
    }

    function productionListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('t1.*,t2.product_name_en,t2.product_name_la,t3.first_name,t3.last_name,t4.farm_name_la,t4.farm_name_en');
        $this->db->from('Production t1');
        $this->db->join('ProductName t2', 't1.product_id = t2.product_id','left');
        $this->db->join('Farmer t3', 't1.farmer_id  = t3.farmer_id','left');
        $this->db->join('Farm t4', 't1.farm_id  = t4.farm_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(t1.planting_date  LIKE '%" . $searchText . "%'
                            OR  t1.harvest_date_befor  LIKE '%" . $searchText . "%'
                            OR  t1.yield_befor  LIKE '%" . $searchText . "%'
                            OR  t1.yield_affter  LIKE '%" . $searchText . "%'
                            OR  t1.harvest_date_affter  LIKE '%" . $searchText . "%'
                            OR  t3.first_name  LIKE '%" . $searchText . "%'
                            OR  t3.last_name  LIKE '%" . $searchText . "%'
                            OR  t4.farm_name_la  LIKE '%" . $searchText . "%'
                            OR  t4.farm_name_en  LIKE '%" . $searchText . "%'
                            OR  t2.product_name_en  LIKE '%" . $searchText . "%'
                            OR  t2.product_name_la  LIKE '%" . $searchText . "%'
                            )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by('t1.production_id', 'desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewProduction($data)
    {
        $this->db->trans_start();
        $this->db->insert('Production', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getProduction($id)
    {

        $this->db->select('*');
        $this->db->from('Production');
        $this->db->where('isdelete', 0);
        $this->db->where('production_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldProduction($data, $id)
    {
        $this->db->where('production_id', $id);
        $this->db->update('Production', $data);

        return TRUE;
    }
    function deleteProduction($id, $data)
    {
        $this->db->where('production_id', $id);
        $this->db->update('Production', $data);

        return $this->db->affected_rows();
    }
    function getproduct($id = null){
        $this->db->select('product_id,product_name_en,product_name_la');
        $this->db->from('ProductName');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('product_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function getfarmer($id = null){
        $this->db->select('farmer_id,first_name,last_name');
        $this->db->from('Farmer');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('farmer_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function getfarm($farmer_id = null,$id=null){
        $this->db->select('farm_id,farm_name_la,farm_name_en');
        $this->db->from('Farm');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('farm_id', $id);
        }
        if($farmer_id){
            $this->db->where('farmer_id', $farmer_id);
        }
        $query = $this->db->get();

        return $query->result();
    }
}
