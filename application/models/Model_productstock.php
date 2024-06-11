<?php

class Model_productstock extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductStockData($productid,$store_id)
	{
	
			$this->db->select('*');
			$this->db->from('product_stock');
			$this->db->where('product_id', $productid);
	
			if ($store_id>0){
				$this->db->where('store_id', $store_id);
			}
			
			$query = $this->db->get();
			return $query->result_array();
		
	}
		/* get the brand data */
		public function getProductStockData1Row($productid,$store_id)
		{
		
				$this->db->select('*');
				$this->db->from('product_stock');
				$this->db->where('product_id', $productid);
		
				if ($store_id>0){
					$this->db->where('store_id', $store_id);
				}
				
				$query = $this->db->get();
				return $query->getRow();
			
		}

	
	public function create($data)
	{
		if ($data) {
			$this->db->insert('product_stock', $data);

			$id = $this->db->insert_id();

			return $id;
		}
	}
	public function addStock($stock_data, $product_id,$store_id,$move_qty){


		return	$this->update(1,$stock_data,$product_id,$store_id,$move_qty);

	}
	public function removeStock($stock_data, $product_id,$store_id,$move_qty){


		return	$this->update(-1,$stock_data,$product_id,$store_id,$move_qty);

	}
	public function update($move_type,$stock_data, $product_id,$store_id,$move_qty)
	{
		if ($stock_data && $product_id && $store_id) {

			$move_data = array(
                'store_id' => $store_id,
				'product_id' => $product_id,
				'qty' =>$move_qty,
				
            );
			$this->db->insert('product_stock_move', $move_data);

			$id = $this->db->insert_id();

			if ($id>0){
				$this->db->where('product_id', $product_id);
				$this->db->where('store_id', $store_id);
				//1: เพิ่ม 
				if ($move_type==1){
					$this->db->set('on_stock', 'on_stock+'.$move_qty, FALSE);
				}else{
					$this->db->set('on_stock', 'on_stock-'.$move_qty, FALSE);
					$this->db->where('on_stock>0');
				}
				
				$update = $this->db->update('product_stock');
			}
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('product_stock');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM product_stock";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
