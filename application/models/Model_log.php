<?php 

class Model_log extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function create($table,$data)
	{
		try {
		if($data) {
			$insert = $this->db->insert($table, $data);
			return ($insert == true) ? true : false;
		}
		}catch(Exception $ex) {
			//
		}
	}


}
