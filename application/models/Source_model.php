<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Source_model extends CI_Model
{
  
  
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

  
  
    function getData($id)
    {
        $this->db->select("*");
        $this->db->from("users");
    
        $this->db->where("id",$id);
        
        $query = $this->db->get();

        return $query->result();
    }
    function getDirectionName($id)
    {
        $this->db->select("direction_name");
        $this->db->from("users");
    
        $this->db->where("id",$id);
        
        $query = $this->db->get();

        return $query->result();
    }
    
    
    
    
    
 
    function addNewUser($userInfo)
    {
    
        $this->db->insert('users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
    
        return $insert_id;
    }
 
  


  
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    

    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }
}