<?php

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($userId = null)
	{
		if ($userId) {
			$sql="t1.*,";
			$this->db->select($sql);
			$this->db->from("users t1");
			$this->db->where('id ',$userId);
			$query=$this->db->get();
			// $sql = "SELECT * FROM users WHERE id = ?";
			// $query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}
		$sql="t1.*";
		$this->db->select($sql);
		$this->db->from("users t1");
		$this->db->where('id >',0);
		$query=$this->db->get();
		// $sql = "SELECT * FROM users WHERE id >0 ";
		// $query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getUserGroup($userId = null)
	{
		if ($userId) {
			//print_r("user=".$userId);
			$sql="t1.*";
			$this->db->select($sql);
			$this->db->from("user_group t1");
			$this->db->where('user_id ',$userId);
			$query=$this->db->get();
			// $sql = "SELECT * FROM user_group WHERE user_id = ?";
			// $query = $this->db->query($sql, array($userId));
			$result = $query->row_array();
			//print_r($result);
			$group_id = $result['group_id'];
			$g_sql="t1.*";
			$this->db->select($g_sql);
			$this->db->from("groups t1");
			$this->db->where('id ',$group_id);
			$g_query=$this->db->get();
			// $g_sql = "SELECT * FROM groups WHERE id = ?";
			// $g_query = $this->db->query($g_sql, array($group_id));
			$q_result = $g_query->row_array();
			return $q_result;
		}
	}

	public function create($data = '', $group_id = null)
	{

		if ($data && $group_id) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();

			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $group_id
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($create == true && $group_data) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $group_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if ($group_id) {
			// user group
			$update_user_group = array('group_id' => $group_id);
			$this->db->where('user_id', $id);
			$user_group = $this->db->update('user_group', $update_user_group);
			$afftectedRows = $this->db->affected_rows();

			if ($afftectedRows == 0){
				
				$group_data = array(
					'user_id' => $id,
					'group_id' => $group_id
				);
				$update = $this->db->insert('user_group', $group_data);
			}

			return ($update == true && $user_group == true) ? true : false;
		}

		return ($update == true) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT * FROM users";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}



	function getsingleUser($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$result = $this->db->get();
		return $result->row();
	}

	

	
}
