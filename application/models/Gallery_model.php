<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model
{
    function galleryListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_gallery ');
 
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return count($query->result());
    }

    function galleryListing( $page = 0, $segment = 0)
    {
        $this->db->select('*');
        $this->db->from('tbl_gallery');

        $this->db->where('isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function addNewGallery($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_gallery', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    function getGallery($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_gallery');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function editOldGallery($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_gallery', $data);
        
        return TRUE;
    }
    function deleteGallery($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_gallery', $data);
        
        return $this->db->affected_rows();
    }
}