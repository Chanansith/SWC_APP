<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Farmer_model extends CI_Model
{
    function farmerListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('Farmer');
        if (!empty($searchText)) {
            $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
                            OR  last_name  LIKE '%" . $searchText . "%'
                            OR  id_card  LIKE '%" . $searchText . "%'
                            OR  issue_date  LIKE '%" . $searchText . "%'
                            OR  exp_date  LIKE '%" . $searchText . "%'
                            OR  id_card_farmer  LIKE '%" . $searchText . "%'
                            OR  birthdate  LIKE '%" . $searchText . "%'
                            OR  phone  LIKE '%" . $searchText . "%')";

            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->order_by('farmer_id', 'desc');
        $query = $this->db->get();

        return count($query->result());
    }

    function farmerListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('Farmer');
        if (!empty($searchText)) {
            $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
                            OR  last_name  LIKE '%" . $searchText . "%'
                            OR  id_card  LIKE '%" . $searchText . "%'
                            OR  issue_date  LIKE '%" . $searchText . "%'
                            OR  exp_date  LIKE '%" . $searchText . "%'
                            OR  id_card_farmer  LIKE '%" . $searchText . "%'
                            OR  birthdate  LIKE '%" . $searchText . "%'
                            OR  phone  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->order_by('farmer_id', 'desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewFarmer($data)
    {
        $this->db->trans_start();
        $this->db->insert('Farmer', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getFarmer($id=null,$referral=null)
    {

        $this->db->select('*');
        $this->db->from('Farmer');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('farmer_id', $id);
        }
        if($referral){
            $this->db->where('my_referral', $referral);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function editOldFarmer($data, $id)
    {
        $this->db->where('farmer_id', $id);
        $this->db->update('Farmer', $data);

        return TRUE;
    }
    function deleteFarmer($id, $data)
    {
        $this->db->where('farmer_id', $id);
        $this->db->update('Farmer', $data);

        return $this->db->affected_rows();
    }
    function getCardFarmer($id)
    {
        $this->db->select('image_card_1,image_card_2');
        $this->db->from('Farmer');
        $this->db->where('farmer_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }
    function getBookFarmer($id)
    {
        $this->db->select('image_book');
        $this->db->from('Farmer');
        $this->db->where('farmer_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }
    function farmListingCount($id, $searchText = '')
    {
        $this->db->select('*');
        $this->db->from('Farm');
        if (!empty($searchText)) {
            $likeCriteria = "(
                farm_name_la  LIKE '%" . $searchText . "%'
            OR  farm_name_en  LIKE '%" . $searchText . "%'
            OR  address   LIKE '%" . $searchText . "%'
            OR  location   LIKE '%" . $searchText . "%'
            OR  size   LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->where('farmer_id', $id);
        $query = $this->db->get();

        return count($query->result());
    }

    function farmListing($id, $searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('Farm');
        if (!empty($searchText)) {
            $likeCriteria = "(
                farm_name_la  LIKE '%" . $searchText . "%'
                            OR  farm_name_en  LIKE '%" . $searchText . "%'
                            OR  address   LIKE '%" . $searchText . "%'
                            OR  location   LIKE '%" . $searchText . "%'
                            OR  size   LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('farmer_id', $id);
        $this->db->where('isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewFarm($data)
    {
        $this->db->trans_start();
        $this->db->insert('Farm', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getImageFarm($id)
    {
        $this->db->select('image_1,image_2,image_3');
        $this->db->from('Farm');
        $this->db->where('farm_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }
    function getFarm($id)
    {

        $this->db->select('*');
        $this->db->from('Farm');
        $this->db->where('isdelete', 0);
        $this->db->where('farm_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldFarm($data, $id)
    {
        $this->db->where('farm_id', $id);
        $this->db->update('Farm', $data);

        return TRUE;
    }
    function deleteFarm($id, $data)
    {
        $this->db->where('farm_id', $id);
        $this->db->update('Farm', $data);

        return $this->db->affected_rows();
    }
}
