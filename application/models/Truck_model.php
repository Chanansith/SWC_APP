<?php

class Truck_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	public function genDocID($code="",$column="id",$table="truck_size"){

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
	   function getSizeForDropdown()
	   {
		   $this->db->select('*');
		   $this->db->from('truck_size');
   
	  
		   $query = $this->db->get();
   
		   $result = $query->result();
		   return $result;
	   }
	/* get the brand data */
	public function getData($id = null,$keyword=null)
	{
		$sql = " t1.*";
		


		$this->db->select($sql);
		$this->db->from("truck_size t1");
	
		
		if ($id) {
			
			$this->db->where('t1.id', $id);

		}
		if ($keyword) {
			
			$this->db->where("  (t1.cust_code LIKE '%$keyword%' OR t1.cust_name_th LIKE '%$keyword%' OR t1.phoneno  LIKE '%$keyword%' )"   );

		}
		
			$this->db->order_by('t1.id', 'desc');
			$this->db->limit(100);
			$query = $this->db->get();


			if ($id) {
			
		
				return $query->row_array();
	
			}else{

				return $query->result_array();
			}
		
	}
	public function getDataByCode($cust_code)
	{
	
			$sql = "SELECT id,cust_name_th FROM truck_size where cust_code = ?";
			$query = $this->db->query($sql, array($cust_code));
			return $query->row_array();
		

	}

	public function getActiveData()
	{
		$sql = "SELECT truck_size.* FROM truck_size ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if ($data) {
			$this->db->insert('truck_size', $data);

			$id = $this->db->insert_id();

			return $id;
		}
	}

	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('truck_size', $data);
			return ($update == true) ? true : false;
		}
	}


	public function countTotal()
	{
		$sql = "SELECT id FROM truck_size";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
