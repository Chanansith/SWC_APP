<?php

class Model_orders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	/* get the po_head data */
	//ไม่ได้ใช้ 
	public function getData($id)
	{
		
		$store_id = $this->session->userdata('store_id');
		$sql = "so_head.* ";
		
		$this->db->select($sql);
		$this->db->from("so_head");
		
		if ($id) {
			
			$this->db->where("so_head.id",$id);
	
		}
		$this->db->where("store_id",$store_id);
		$this->db->order_by("id","desc");
		$this->db->limit(200);
		$query = $this->db->get();
	//	print_r($this->db->last_query());
		if ($id) {
			return $query->row_array();

		}else{

			return $query->result_array();
		}

	}
	public function getSODocDate($id)
	{
		$sql = "so_head.doc_date ";
		
		$this->db->select($sql);
		$this->db->from("so_head");
		$this->db->where("so_head.id",$id);

		$query = $this->db->get();
	
		return $query->result_array();
		
	}
	public function getGroupbyDocDate()
	{
		$sql = "t1.* ";
		
		$this->db->select($sql);
		$this->db->from("so_head t1");
		$this->db->group_by('t1.doc_date,t1.id'); 
		$this->db->order_by('t1.id', 'desc');
		$this->db->limit(60);
		$query = $this->db->get();
	
		return $query->result_array();
		
	}
	public function getItemData($so_id,$doc_date=null)
	{
		
		$sql = "so_item.*,products.name as product_name,users.username ";
		
		$this->db->select($sql);
		$this->db->from("so_item");
		$this->db->join("products","so_item.product_id=products.id");
		$this->db->join("users","so_item.user_id=users.id");

		if ($so_id>0) {
			
			$this->db->where("so_item.so_id",$so_id);
	
		}
		if ($doc_date) {
			
		
			$this->db->where('DATE(so_item.doc_date) >=', date('Y-m-d',strtotime($doc_date)));
	
		}
		
		$this->db->limit(100);
		$query = $this->db->get();
	//	print_r($this->db->last_query());
		

		return $query->result_array();
	
	}
	public function getItemDataByID($id,$doc_date=null)
	{
		
		$sql = "so_item.*,customers.name as customer_name,products.name as product_name,users.username";
		
		$this->db->select($sql);
		$this->db->from("so_item");
		$this->db->join("customers","so_item.cust_id=customers.id");
		$this->db->join("products","so_item.product_id=products.id");
		$this->db->join("users","so_item.user_id=users.id");
		
		if ($id>0) {
			
			$this->db->where("so_item.id",$id);
	
		}
		
		$this->db->limit(100);
		$query = $this->db->get();
	//	print_r($this->db->last_query());
		

		return $query->row_array();
	
	}
	public function getLastSO(){

	
		$query = $this->db->select(" * ")
						  ->from("so_head")
						  ->get();
		$row = $query->last_row();
		
		return $row;
 	}

	public function getLastSOID(){

	
		   $query = $this->db->select("id")
							 ->from("so_head")
							 ->get();
		   $row = $query->last_row();
		   if($row){
			   return (int)$row->id;
		   }else{
			   return 0;
		   }
	}

	public function genDocID($code,$column="id",$table="so_head"){

	 $doc_id=$code.date("Ymd");
	
		$query = $this->db->select($column)
						  ->from($table)
						  ->get();
		$row = $query->last_row();
		if($row){
			$idPostfix = (int)$row->id+1;
			$nextId = STR_PAD((string)$idPostfix,4,"0",STR_PAD_LEFT);
		}
		else{
			$nextId = '0001';
		} // For the first time
	
	

	 return $doc_id.$nextId;
	}

	
	public function create()
	{

		$data['status']=2; 
		$data['order_id']=0;

		$so_id=0;
		//ดึง user id และ รหัสสาขา
		$user_id = $this->session->userdata('id');
		$store_id = $this->session->userdata('store_id');
		$this->load->model('model_log');

		try {
		
			//$store_id=1;
			if ($store_id==0){
				throw new Exception("ไม่พบสาขา");
			}
	
			$count_product_post = count($this->input->post('product'));
			$count_product=0;
			//นับเฉพาะสินค้าที่มีการเลือก
			for ($x = 0; $x < $count_product_post; $x++) {
				$product_id= $this->input->post('product')[$x];
				if ($product_id>0){
					$count_product++;
				}
			}
			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => 0,
				'doc_code' 	=> "",
				'remark' 		=> "create po count=".$count_product
			);

			$this->model_log->create("so_log",$log_data);
			$doc_date=date("Y-m-d",strtotime($_POST['doc_date']));

			//บันทึกลง หัวเอกสาร
			$data = array(
				'doc_date' => $doc_date,
				'total_amount' => $this->input->post('total_amount'),
				'item_count' => $count_product,
				'store_id' => $store_id,
				'user_id' => $user_id
			);
			
			$insert = $this->db->insert('so_head', $data);
			$so_id = $this->db->insert_id();

			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => $so_id,
				'doc_code' 	=> "",
				'remark' 		=> "create so success"
			);

			$this->model_log->create("so_log",$log_data);

			$this->load->model('model_products');
			$this->load->model('model_productstock');

			for ($x = 0; $x < $count_product_post; $x++) {
				$product_id= $this->input->post('product')[$x];
				if ($product_id>0){
				
					$on_stock=$this->input->post('qty')[$x];
					//log
					$log_data = array(
						'createby' => $this->session->userdata ('id'),
						'ip'  =>"",
						'doc_id'     => $so_id,
						'doc_code' 	=> "",
						'remark' 		=> "begin insert pid=".$product_id
					);
		
					$this->model_log->create("so_log",$log_data);
					//end log

					$items = array(
						'doc_date' => $doc_date,
						'so_id' => $so_id,
						'product_name' =>  $this->input->post('product_name')[$x],
						'unit_name' =>  $this->input->post('unit_name')[$x],
						'product_id' => $product_id,
						'rate' =>  $this->input->post('rate')[$x],
						'qty' =>  $on_stock,
						'amount' =>  $this->input->post('amount')[$x],
						'sale_unit_id' => $this->input->post('unit')[$x],
						'category_id' => $this->input->post('category')[$x],
						'item_remark' => $this->input->post('item_remark')[$x],
						'store_id' => $store_id,
						'user_id' => $user_id
					);

					$this->db->insert('so_item', $items);

					$item_id = $this->db->insert_id();

					$log_data = array(
						'createby' => $this->session->userdata ('id'),
						'ip'  =>"",
						'doc_id'     => $item_id,
						'doc_code' 	=> "",
						'remark' 		=> "insert item pid=".$product_id
					);
		
					$this->model_log->create("so_log",$log_data);
					
					$items_move = array(
						'doc_id' => $item_id,
						'move_type' => '-',
						'user_id' => $user_id,
						'product_id' => $product_id,
						'store_id' => $store_id,
						'qty' => $on_stock
					);
					$this->db->insert('product_stock_move', $items_move);

					//เป็นการตัดสต็อกออก

							$this->db->where('product_id', $product_id);
							$this->db->where('store_id', $store_id);
							$this->db->set('on_stock', 'on_stock-'.$on_stock, FALSE);
							$update_stock = $this->db->update('product_stock');
							$log_data = array(
								'createby' => $this->session->userdata ('id'),
								'ip'  =>"",
								'doc_id'     => $so_id,
								'doc_code' 	=> "",
								'remark' 		=> "update stock success pid=".$product_id
							);
				
						$this->model_log->create("so_log",$log_data);
					
				 }
			   
				
				}

				$data['status']=1;

				$data['order_id']=$so_id;
				
				
				return $data;

			}

		catch (Exception $ex){
			$data['err']=$ex->getMessage();
			return $data;

		}

		return $data;
	}

	public function countOrderItem($so_id)
	{
		if ($so_id) {
			$sql = "SELECT * FROM so_item WHERE id = ?";
			$query = $this->db->query($sql, array($so_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if ($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
//				'customer_facebook' => $this->input->post('customer_facebook'),
				'supplier_id' => $this->input->post('supplier_id'),
				'gross_amount' => $this->input->post('gross_amount_value'),
				'gross_lak_amount' => 0,
				'service_charge_rate' => $this->input->post('service_charge_rate'),
				'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value') : 0,
				'service_lak_charge' =>  0,
				'vat_charge_rate' => $this->input->post('vat_charge_rate'),
				'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
				'vat_lak_charge' =>  0,
				'net_amount' => $this->input->post('net_amount_value'),
				'net_amount_lak' => 0,
				'discount' => $this->input->post('discount'),
				'discount_lak' => 0,
				'paid_status' => $this->input->post('paid_status'),
				'tracking_status' => $this->input->post('tracking_status'),
			
				'order_note' => $this->input->post('order_note'),
				'order_date' => $this->input->post('order_date'),
				'user_id' => $user_id
			);

		
			$data['delivery_date'] = date("Y-m-d");
			

			$this->db->where('id', $id);
			$update = $this->db->update('so_head', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getpo_headItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);

				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('so_id', $id);
			$this->db->delete('so_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
			for ($x = 0; $x < $count_product; $x++) {
				$items = array(
					'so_id' => $id,
					'product_id' => $this->input->post('product')[$x],
					'qty' => $this->input->post('qty')[$x],
					'rate' => $this->input->post('rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
				);
				$this->db->insert('so_item', $items);

				// now decrease the stock from the product
				$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
				$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

				$update_product = array('qty' => $qty);
				$this->model_products->update($update_product, $this->input->post('product')[$x]);
			}

			return true;
		}
	}
	public function returnproduct($id, $qty, $product_id)
	{
		$sql = "select qty from products where id='$product_id'";
		$query = $this->db->query($sql);
		$datares =  $query->result_array();
		//		echo $sql;
		$qtyOld  = $datares[0]["qty"];

		$data = array("qty" => ($qty + $qtyOld));
		//		print_r($data);
		$this->db->where("id", $product_id);
		$this->db->update("products", $data);

		$data = array("return_status" => "1", "return_by" => "1");
		$this->db->where("id", $id);
		$this->db->update("po_head", $data);

		redirect(base_url('po_head'));
	}
	public function getprovinces()
	{
		return null;
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('po_head');

			$this->db->where('so_id', $id);
			$delete_item = $this->db->delete('so_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidpo_head()
	{
		$sql = "SELECT * FROM po_head WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function updateItem($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('so_item', $data);
			return ($update == true) ? true : false;
		}
	}
}
