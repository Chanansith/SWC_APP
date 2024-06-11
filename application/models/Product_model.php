<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
    function categoryListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('ProductCategory');
        if (!empty($searchText)) {
            $likeCriteria = "(category_name_la  LIKE '%" . $searchText . "%'
                            OR  category_name_en  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $query = $this->db->get();

        return count($query->result());
    }

    function categoryListing($searchText = '', $page = 0, $segment = 0)
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
    function addNewcategory($data)
    {
        $this->db->trans_start();
        $this->db->insert('ProductCategory', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getCategory($id = null)
    {
        $this->db->select('*');
        $this->db->from('ProductCategory');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('category_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function editOldCategory($data, $id)
    {
        $this->db->where('category_id', $id);
        $this->db->update('ProductCategory', $data);

        return TRUE;
    }
    function deleteCategory($id, $data)
    {
        $this->db->where('category_id', $id);
        $this->db->update('ProductCategory', $data);

        return $this->db->affected_rows();
    }
    function subtypeListingCount($id, $searchText = '')
    {
        $this->db->select('*');
        $this->db->from('ProductSubCategory');
        if (!empty($searchText)) {
            $likeCriteria = "(category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  category_sub_name_en  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->where('category_id', $id);
        $query = $this->db->get();

        return count($query->result());
    }

    function subtypeListing($id, $searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('ProductSubCategory');
        if (!empty($searchText)) {
            $likeCriteria = "(category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  category_sub_name_en  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('category_id', $id);
        $this->db->where('isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewSubtype($data)
    {
        $this->db->trans_start();
        $this->db->insert('ProductSubCategory', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getSubtype($id = null)
    {

        $this->db->select('*');
        $this->db->from('ProductSubCategory');
        $this->db->where('isdelete', 0);
        if($id){

            $this->db->where('category_sub_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function editOldSubtype($data, $id)
    {
        $this->db->where('category_sub_id', $id);
        $this->db->update('ProductSubCategory', $data);

        return TRUE;
    }
    function deleteSubtype($id, $data)
    {
        $this->db->where('category_sub_id', $id);
        $this->db->update('ProductSubCategory', $data);

        return $this->db->affected_rows();
    }
    function plantListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('PlantVariety');
        if (!empty($searchText)) {
            $likeCriteria = "(variety_name_en  LIKE '%" . $searchText . "%'
                            OR  variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $query = $this->db->get();

        return count($query->result());
    }

    function plantListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('PlantVariety');
        if (!empty($searchText)) {
            $likeCriteria = "(variety_name_en  LIKE '%" . $searchText . "%'
                            OR  variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewPlants($data)
    {
        $this->db->trans_start();
        $this->db->insert('PlantVariety', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getPlant($id = null)
    {

        $this->db->select('*');
        $this->db->from('PlantVariety');
        $this->db->where('isdelete', 0);
        if($id){
            $this->db->where('variety_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function editOldPlants($data, $id)
    {
        $this->db->where('variety_id', $id);
        $this->db->update('PlantVariety', $data);

        return TRUE;
    }
    function deletePlants($id, $data)
    {
        $this->db->where('variety_id', $id);
        $this->db->update('PlantVariety', $data);

        return $this->db->affected_rows();
    }
    function product_nameListingCount($searchText = '')
    {
        $this->db->select('pn.product_id,pn.product_image,pn.product_name_en,pn.product_name_la,pn.product_description_en,pn.product_description_la,pc.category_name_la,pc.category_name_en,psc.category_sub_name_la,psc.category_sub_name_en,pv.variety_name_en,pv.variety_name_la');
        $this->db->from('ProductName as pn');
        $this->db->join('ProductCategory as pc', 'pn.product_category_id = pc.category_id','left');
        $this->db->join('ProductSubCategory as psc', 'pn.product_category_sub_id = psc.category_sub_id','left');
        $this->db->join('PlantVariety as pv', 'pn.variety_id = pv.variety_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(pn.product_name_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_name_la  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_en  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('pn.isdelete', 0);
        $query = $this->db->get();

        return count($query->result());
    }

    function product_nameListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('pn.product_id,pn.product_image,pn.product_name_en,pn.product_name_la,pn.product_description_en,pn.product_description_la,pc.category_name_la,pc.category_name_en,psc.category_sub_name_la,psc.category_sub_name_en,pv.variety_name_en,pv.variety_name_la');
        $this->db->from('ProductName as pn');
        $this->db->join('ProductCategory as pc', 'pn.product_category_id = pc.category_id','left');
        $this->db->join('ProductSubCategory as psc', 'pn.product_category_sub_id = psc.category_sub_id','left');
        $this->db->join('PlantVariety as pv', 'pn.variety_id = pv.variety_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(pn.product_name_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_name_la  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_en  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('pn.isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewProduct_name($data)
    {
        $this->db->trans_start();
        $this->db->insert('ProductName', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getProduct_name($id)
    {

        $this->db->select('*');
        $this->db->from('ProductName');
        $this->db->where('isdelete', 0);
        $this->db->where('product_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldProduct_name($data, $id)
    {
        $this->db->where('product_id', $id);
        $this->db->update('ProductName', $data);

        return TRUE;
    }
    function deleteProduct_name($id, $data)
    {
        $this->db->where('product_id', $id);
        $this->db->update('ProductName', $data);

        return $this->db->affected_rows();
    }
    function product_platformListingCount($searchText = '')
    {
        $this->db->select('pn.product_id,pn.product_image,pn.product_name_en,pn.product_name_la,pn.product_description_en,pn.product_description_la,pc.category_name_la,pc.category_name_en,psc.category_sub_name_la,psc.category_sub_name_en,pv.variety_name_en,pv.variety_name_la');
        $this->db->from('ProductPlatform as pn');
        $this->db->join('ProductCategory as pc', 'pn.product_category_id = pc.category_id','left');
        $this->db->join('ProductSubCategory as psc', 'pn.product_category_sub_id = psc.category_sub_id','left');
        $this->db->join('PlantVariety as pv', 'pn.variety_id = pv.variety_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(pn.product_name_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_name_la  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_en  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('pn.isdelete', 0);
        $query = $this->db->get();

        return count($query->result());
    }

    function product_platformListing($searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select('pn.price_ldt,pn.price_lao,pn.product_id,pn.product_image,pn.product_name_en,pn.product_name_la,pn.product_description_en,pn.product_description_la,pc.category_name_la,pc.category_name_en,psc.category_sub_name_la,psc.category_sub_name_en,pv.variety_name_en,pv.variety_name_la');
        $this->db->from('ProductPlatform as pn');
        $this->db->join('ProductCategory as pc', 'pn.product_category_id = pc.category_id','left');
        $this->db->join('ProductSubCategory as psc', 'pn.product_category_sub_id = psc.category_sub_id','left');
        $this->db->join('PlantVariety as pv', 'pn.variety_id = pv.variety_id','left');
        if (!empty($searchText)) {
            $likeCriteria = "(pn.product_name_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_name_la  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_en  LIKE '%" . $searchText . "%'
                            OR  pn.product_description_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_la  LIKE '%" . $searchText . "%'
                            OR  pc.category_name_en  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_la  LIKE '%" . $searchText . "%'
                            OR  psc.category_sub_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_en  LIKE '%" . $searchText . "%'
                            OR  pv.variety_name_la  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('pn.isdelete', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function addNewProduct_platform($data)
    {
        $this->db->trans_start();
        $this->db->insert('ProductPlatform', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getProduct_platform($id)
    {

        $this->db->select('*');
        $this->db->from('ProductPlatform');
        $this->db->where('isdelete', 0);
        $this->db->where('product_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function editOldProduct_platform($data, $id)
    {
        $this->db->where('product_id', $id);
        $this->db->update('ProductPlatform', $data);

        return TRUE;
    }
    function deleteProduct_platform($id, $data)
    {
        $this->db->where('product_id', $id);
        $this->db->update('ProductPlatform', $data);

        return $this->db->affected_rows();
    }
}
