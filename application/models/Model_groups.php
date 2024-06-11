<?php 

class Model_groups extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getGroupData($groupId = null) 
	{
		if($groupId) {
			$this->db->select('*');
			$this->db->from('groups');
			$this->db->where('id',$groupId);
			$query = $this->db->get();
			// $sql = "SELECT * FROM groups WHERE id = ?";
			// $query = $this->db->query($sql, array($groupId));
			return $query->row_array();
		}

		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('id >',0);
		$query = $this->db->get();
		return $query->result_array();
		// $sql = "SELECT * FROM groups WHERE id >? ";
		// $query = $this->db->query($sql, array(0));
		// return $query->result_array();
	}

	public function create($data = '')
	{
		$create = $this->db->insert('groups', $data);

		
		$id = $this->db->insert_id();

		return $id;
		
	}

	public function edit($data, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('groups', $data);
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('groups');
		return ($delete == true) ? true : false;
	}

	public function existInUserGroup($id)
	{
		$sql = "SELECT * FROM user_group WHERE group_id = ?";
		$query = $this->db->query($sql, array($id));
		return ($query->num_rows() == 1) ? true : false;
	}

	public function getUserGroupByUserId($user_id) 
	{
		$this->db->select('*');
		$this->db->from('user_group');
		$this->db->join('groups','groups.id = user_group.group_id ');
		$this->db->where('user_group.user_id',$user_id);
		$query = $this->db->get();
		return $query->row_array();

		// $sql = "SELECT * FROM user_group 
		// INNER JOIN groups ON groups.id = user_group.group_id 
		// WHERE user_group.user_id = ?";
		// $query = $this->db->query($sql, array($user_id));
		// $result = $query->row_array();

		// return $result;

	}
}