<?php 

class Model_supplier extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

		
	public function genDocID($code="S",$column="id",$table="suppliers"){

		$doc_id=$code;
   
	   $query = $this->db->select($column)
						 ->from($table)
						 ->get();
	   $row = $query->last_row();
	   if($row){
		   $idPostfix = (int)$row->id+1;
		   $nextId = STR_PAD((string)$idPostfix,6,"0",STR_PAD_LEFT);
	   }
	   else{
		   $nextId = '100001';
	   } // For the first time
   
   

	return $doc_id.$nextId;
   }
	/* get active brand infromation */
	public function getActive()
	{
		$sql = "SELECT * FROM suppliers WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	/* get the brand data */
	public function getData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM suppliers WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM suppliers";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('suppliers', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function createSub($data)
	{
		if($data) {
			$insert = $this->db->insert('sub_suppliers', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('suppliers', $data);
			return ($update == true) ? true : false;
		}
	}


	public function remove($id)
	{
		if($id) {
			

			$this->db->where('id', $id);
			$this->db->set('active', 0, FALSE);
			$delete = $this->db->update('suppliers');

			return ($delete == true) ? true : false;
		}
	}
	
	

}
