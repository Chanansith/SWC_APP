<?php

class Model_customers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	public function genDocID($code="",$column="id",$table="customers"){

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
	/* get the brand data */
	public function getData($id = null,$keyword=null)
	{
		$sql = " t1.*";
		


		$this->db->select($sql);
		$this->db->from("customers t1");
		//$this->db->join("product_stock t2","t1.id=t2.product_id","left");
		
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
	
			$sql = "SELECT id,cust_name_th FROM customers where cust_code = ?";
			$query = $this->db->query($sql, array($cust_code));
			return $query->row_array();
		

	}

	public function getActiveData()
	{
		$sql = "SELECT customers.* FROM customers ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if ($data) {
			$this->db->insert('customers', $data);

			$id = $this->db->insert_id();

			return $id;
		}
	}

	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('customers', $data);
			return ($update == true) ? true : false;
		}
	}


	public function countTotal()
	{
		$sql = "SELECT id FROM customers";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
