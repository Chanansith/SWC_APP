<?php

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	/* get the brand data */
	public function getData($id = null)
	{

		$store_id = $this->session->userdata('store_id');
		$sql = " t1.*,t2.on_stock,t4.name as unit_name,t3.name as category_name";
		
		$this->db->select($sql);
		$this->db->from("products t1");
		$this->db->join("categories t3","t1.category_id=t3.id");
		$this->db->join("units t4","t1.sale_unit_id=t4.id");
		$this->db->join("product_stock t2","t1.id=t2.product_id","left");
		
		if ($id) {	
			$this->db->where('t1.id', $id);
			//$this->db->where('t2.store_id', $store_id);
		}
		
		$this->db->where('t1.availability<2');
		$this->db->group_by('t1.id'); 
		$this->db->order_by('t1.id', 'desc');
		//$this->db->limit(100);
		$query = $this->db->get();
		//print_r($this->db->last_query());

		if ($id) {
			return $query->row_array();
			}else{
			return $query->result_array();
		}
		
	}
	public function getDataByID($id)
	{

		$store_id = $this->session->userdata('store_id');
		$sql = " t1.*,t2.on_stock,t4.name as unit_name,t3.name as category_name";
		
		$this->db->select($sql);
		$this->db->from("products t1");
		$this->db->join("categories t3","t1.category_id=t3.id");
		$this->db->join("units t4","t1.sale_unit_id=t4.id");
		$this->db->join("product_stock t2","t1.id=t2.product_id");
		
	
		$this->db->where('t1.id', $id);
		$this->db->where('t2.store_id', $store_id);	
		
		$this->db->where('t1.availability<2');
	
		$this->db->order_by('t1.id', 'desc');
		//$this->db->limit(100);
		$query = $this->db->get();
		//print_r($this->db->last_query());

		if ($id) {
			return $query->row_array();
			}else{
			return $query->result_array();
		}
		
	}

	public function getDataByStoreID($store_id)
	{

		
		$sql = " t1.*,t2.on_stock";
		
		$this->db->select($sql);
		$this->db->from("products t1");
		$this->db->join("product_stock t2","t1.id=t2.product_id");
		
		if ($store_id) {	
			$this->db->where('t1.store_id', $store_id);
		}
		
		$this->db->order_by('t1.id', 'desc');
		$this->db->limit(100);
		$query = $this->db->get();

		if ($store_id) {
			return $query->row_array();
			}else{
				return $query->result_array();
		}
		
	}

	//ดึงสต็อกจากสาขา

	public function getStockDataByStoreID($id,$store_id)
	{

	
		$sql = " t2.on_stock ";
		$this->db->select($sql);
		$this->db->from("products t1");
		$this->db->join("product_stock t2","t1.id=t2.product_id");
		$this->db->where('t1.id', $id);
		$this->db->where('t2.store_id', $store_id);
		$query = $this->db->get();
	
		return $query->row_array();
			
		
	}
	public function getDataForOrder($product_code)
	{

		$store_id = $this->session->userdata('store_id');
		$sql = " t1.*,t2.on_stock,
				t3.name as group_name,t4.name_th as supplier_name
				";
		


		$this->db->select($sql);
		$this->db->from("products t1");
		$this->db->join("product_stock t2","t1.id=t2.product_id","left");
		$this->db->join("product_group t3","t1.product_group_id=t3.id","left");
		$this->db->join("suppliers t4","t1.supplier_id=t4.id","left");
		
		$this->db->where("t1.product_code",$product_code);

		
			$this->db->order_by('t1.id', 'desc');
			
			$query = $this->db->get();


		//print_r ($this->db->last_query());
		
		return $query->row_array();
	
		
	}
	public function getProductDataByCode($product_code)
	{
	
			$sql = "SELECT id,name FROM products where product_code = ?";
			$query = $this->db->query($sql, array($product_code));
			return $query->row_array();
		
	}
	//สำหรับตอนขาย
	public function getProductDataForDropdown()
	{
			$sql = "SELECT id,name FROM products ";
			$query = $this->db->query($sql, array(0));
			return $query->result_array();
	}
	
	

	public function create($data)
	{
		if ($data) {
			$this->db->insert('products', $data);

			$id = $this->db->insert_id();
			return $id;
		}
	}
	/*
	product_id
	store_id
	*/
	public function create_stock($data)
	{
		if ($data) {
			$this->db->insert('product_stock', $data);

			$id = $this->db->insert_id();
			return $id;
		}
	}

	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function update_stock($data, $id,$store_id)
	{
		if ($data && $id) {
			$this->db->where('product_id', $id);
			$this->db->where('store_id', $store_id);
			$update = $this->db->update('product_part_stock', $data);
			return ($update == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
