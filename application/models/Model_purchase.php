<?php

class Model_purchase extends CI_Model
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
		$sql = "po_head.*
					";
		
		$this->db->select($sql);
		$this->db->from("po_head");
		
		
		if ($id) {
			$this->db->where("id",$id);
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
	public function getGroupbyDocDate()
	{
		$sql = "t1.id,t1.doc_date ";
		
		$this->db->select($sql);
		$this->db->from("po_head t1");
		$this->db->group_by('t1.doc_date,t1.id'); 
		$this->db->order_by('t1.id', 'desc');
		$this->db->limit(60);
		$query = $this->db->get();
		//print_r($this->db->last_query());
	
		return $query->result_array();
		
	}
	public function getItemData($po_id,$doc_date=null)
	{
		$store_id = $this->session->userdata('store_id');
		$sql = "po_item.*,users.username";
		
		$this->db->select($sql);
		$this->db->from("po_item");
		
		$this->db->join("users","po_item.user_id=users.id");
		//$this->db->join("units","po_item.po_unit_id=units.id");
		if ($po_id>0) {
			
			$this->db->where("po_item.po_id",$po_id);
	
		}
		if ($doc_date) {
			
		
			$this->db->where('DATE(po_item.doc_date) >=', date('Y-m-d',strtotime($doc_date)));
	
		}
		$this->db->where("po_item.store_id",$store_id);
		$this->db->order_by("id","desc");
		$this->db->limit(1000);
		$query = $this->db->get();
	//	print_r($this->db->last_query());
		

		return $query->result_array();
	
	}
	public function getPO($id){
		$sql = "*";
		$this->db->select($sql);
		$this->db->from("po_head");
		$this->db->where("id",$id);
	
		$query = $this->db->get();
		return $query->last_row();

 	}
	 public function getPODocDate($id)
	 {
		 $sql = "po_head.doc_date ";
		 
		 $this->db->select($sql);
		 $this->db->from("po_head");
		 $this->db->where("po_head.id",$id);
 
		 $query = $this->db->get();
	 
		 return $query->row_array();
		 
	 }
	 public function getPOByDate($doc_date)
	 {
		 $sql = "po_head.doc_date ";
		 
		 $this->db->select($sql);
		 $this->db->from("po_head");
		 $this->db->where('DATE(doc_date) >=',$doc_date);
 
		 $query = $this->db->get();
	 
		 return $query->num_rows();
		 
	 }

	public function getLastPO(){

		$store_id = $this->session->userdata('store_id');
		$this->db->select(" * ");
						
		$this->db->from("po_head");
		$this->db->where("store_id",$store_id);

		$query = $this->db->get();
		$row = $query->last_row();
		
		return $row;
 	}

	public function getLastPOID(){

	
		   $query = $this->db->select("id")
							 ->from("po_head")
							 ->get();
		   $row = $query->last_row();
		   if($row){
			   return (int)$row->id;
		   }else{
			   return 0;
		   }
	}

	public function genDocID($code,$column="id",$table="po_head"){

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
		$po_id=0;
		//ดึง user id และ รหัสสาขา
		$user_id = $this->session->userdata('id');
		$store_id = $this->session->userdata('store_id');
		$this->load->model('model_log');

		try {
		

			if ($store_id==0){
				throw new Exception("ไม่พบสาขา");
			}
	
			$count_product_post = count($this->input->post('product'));
			//print_r($count_product_post);
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

			$this->model_log->create("po_log",$log_data);
			$doc_date=date("Y-m-d",strtotime($_POST['doc_date']));

			$data = array(
				'doc_date' => $doc_date,
				'total_amount' => $this->input->post('total_amount'),
				'item_count' => $count_product,
				'store_id' => $store_id,
				'user_id' => $user_id
			);
	

			$insert = $this->db->insert('po_head', $data);
			$po_id = $this->db->insert_id();

			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => $po_id,
				'doc_code' 	=> "",
				'remark' 		=> "create po success"
			);

			$this->model_log->create("po_log",$log_data);

			$this->load->model('model_products');
			$this->load->model('model_productstock');


			for ($x = 0; $x < $count_product_post; $x++) {
				//print_r($x);
				//print_r($this->input->post('product')[$x]);
				$product_id= $this->input->post('product')[$x];
				
				$on_remain=$this->input->post('on_remain')[$x];
				//on_stock คือค่าจากระบบก่อนเปลียน
				$on_stock=$this->input->post('on_stock')[$x];
				if ($product_id>0 && $on_stock>0 && $on_stock>=$on_remain){
				
				   $item_remark=$this->input->post('item_remark')[$x];
				  	
				   $log_data = array(
					'createby' => $this->session->userdata ('id'),
					'ip'  =>"",
					'doc_id'     => $product_id,
					'doc_code' 	=>  $this->input->post('product_name')[$x],
					'remark' 		=> "update stock -".$on_stock." by remain=".$on_remain
				);
	
				$this->model_log->create("po_log",$log_data);

				   $on_sale=$on_stock-$on_remain;


				   $sale_amount=0;
				   if ( $on_sale>0){
				   	$sale_amount=$on_sale*$this->input->post('sale_price')[$x];
				   }
				   //07/04/2021 ปรับให้สต็อกที่เหลือจริง คือ on_remain
					$items = array(
						'doc_date' => $doc_date,
						'po_id' => $po_id,
						'po_unit_id' =>  $this->input->post('unit')[$x],
						'product_name' =>  $this->input->post('product_name')[$x],
						'unit_name' =>  $this->input->post('unit_name')[$x],
						'product_id' => $product_id,
						'qty' =>  $on_stock,
						'on_stock' => $on_stock,
						'rate' => 0,
						'on_remain' => $on_remain,
						'on_sale' => $on_sale,
						'sale_amount' => $sale_amount,
						'item_remark' => $this->input->post('item_remark')[$x],
						'store_id' => $store_id,
						'user_id' => $user_id
					);

					$this->db->insert('po_item', $items);

					$item_id = $this->db->insert_id();
					//อ้างอินถึง รหัส รายการ
					$items_move = array(
						'doc_id' => $item_id,
						'user_id' => $user_id,
						'product_id' => $product_id,
						'store_id' => $store_id,
						'qty' => $on_remain
					);
					$this->db->insert('product_stock_move', $items_move);

						// now decrease the stock from the product
					$product_stock_data = $this->model_productstock->getProductStockData($product_id,$store_id);
					if ($product_stock_data==null || count(	$product_stock_data )==0){

						//ส๖
						$insert_stock_data = array(
							'product_id' => $product_id,
							'store_id' => $store_id,
							'on_stock' => $on_remain
						);
						$this->db->insert('product_stock', $insert_stock_data);
						$log_data = array(
							'createby' => $this->session->userdata ('id'),
							'ip'  =>"",
							'doc_id'     => $po_id,
							'doc_code' 	=> "",
							'remark' 		=> "create new stock success pid=".$product_id
						);
			
						$this->model_log->create("po_log",$log_data);
			

					}else {
				
							//ลบยอดที่ขายได้

							$this->db->where('product_id', $product_id);
							$this->db->where('store_id', $store_id);
							$this->db->set('on_stock', 'on_stock-'.$on_sale, FALSE);
							$update_stock = $this->db->update('product_stock');
							$log_data = array(
								'createby' => $this->session->userdata ('id'),
								'ip'  =>"",
								'doc_id'     => $po_id,
								'doc_code' 	=> "",
								'remark' 		=> "update stock -".$on_sale." success pid=".$product_id
							);
				
							$this->model_log->create("po_log",$log_data);

					}
					
				 }
				 //end if product 
			   }
					
				
				
				return $po_id;

			}

		catch (Exception $ex){

			return 0;

		}
		return $po_id;
	}

	public function addRemainStock($product_id,$product_data)
	{
		$po_id=0;
		//ดึง user id และ รหัสสาขา
		$user_id = $this->session->userdata('id');
		$store_id = $this->session->userdata('store_id');
		$this->load->model('model_log');

		try {
		

			if ($store_id==0){
				throw new Exception("ไม่พบสาขา");
			}
	
			
			$doc_date=date("Y-m-d",strtotime($_POST['doc_date']));


			$this->load->model('model_products');
			$this->load->model('model_productstock');

			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => 0,
				'doc_code' 	=> '',
				'remark' 		=> "create new onsale  pid=".$product_id
			);

			$this->model_log->create("po_log",$log_data);
		
		

			$on_stock=$product_data["on_stock"];
			$on_remain=$this->input->post('on_remain');
			$on_sale=0;
			$rate=0;
			$sale_amount=0;

		
			$on_sale=$on_stock-$on_remain;

			
			if ( $on_sale>0 && $product_data["sale_price"]>0){

				$sale_amount=$on_sale*$product_data["sale_price"];
			}
			
			
			

			$move_type=1; // หมายถึงขาย
			$items = array(
						'doc_date' => $doc_date,
						'po_id' => 0,
						'po_unit_id' =>  $product_data["po_unit_id"],
						'product_name' =>  $product_data["name"],
						'unit_name' =>   $product_data["unit_name"],
						'product_id' => $product_id,
						'qty' =>  $on_sale,
						'on_stock' => $on_sale,
						'rate' => $rate,
						'on_remain' => $on_remain,
						'on_sale' => $on_sale,
						'sale_amount' => $sale_amount,
						'move_type' => 1,
						'item_remark' => $this->input->post('item_remark'),
						'store_id' => $store_id,
						'user_id' => $user_id
					);

					$this->db->insert('po_item', $items);

					$item_id = $this->db->insert_id();
					//อ้างอินถึง รหัส รายการ
					$items_move = array(
						'doc_id' => $item_id,
						'user_id' => $user_id,
						'product_id' => $product_id,
						'store_id' => $store_id,
						'qty' => $on_sale
					);
					$this->db->insert('product_stock_move', $items_move);

						// now decrease the stock from the product
					$product_stock_data = $this->model_productstock->getProductStockData($product_id,$store_id);
					if ($product_stock_data==null || count(	$product_stock_data )==0){

						//เพิ่มสินค้าลงในสต็อก
						$insert_stock_data = array(
							'product_id' => $product_id,
							'store_id' => $store_id,
							'on_stock' => $on_remain
						);
						$this->db->insert('product_stock', $insert_stock_data);
						$log_data = array(
							'createby' => $this->session->userdata ('id'),
							'ip'  =>"",
							'doc_id'     => 0,
							'doc_code' 	=> "",
							'remark' 		=> "create on sale success pid=".$product_id
						);
			
						$this->model_log->create("po_log",$log_data);
			

					}else {
				
							

							$this->db->where('product_id', $product_id);
							$this->db->where('store_id', $store_id);
							$this->db->where('on_stock>0');
							$this->db->set('on_stock', 'on_stock-'.$on_sale, FALSE);
							
							$update_stock = $this->db->update('product_stock');
							$log_data = array(
								'createby' => $this->session->userdata ('id'),
								'ip'  =>"",
								'doc_id'     => $po_id,
								'doc_code' 	=> "",
								'remark' 		=> "update stock success pid=".$product_id
							);
				
							$this->model_log->create("po_log",$log_data);

					}
					
				
					
				return true;

			}

		catch (Exception $ex){

			return false;

		}
		return true;
	}

	public function addStock($product_id)
	{
		$po_id=0;
		//ดึง user id และ รหัสสาขา
		$user_id = $this->session->userdata('id');
		$store_id = $this->session->userdata('store_id');
		$this->load->model('model_log');

		try {
		

			if ($store_id==0){
				throw new Exception("ไม่พบสาขา");
			}
	
			
			$doc_date=date("Y-m-d",strtotime("now"));


			$this->load->model('model_products');
			$this->load->model('model_productstock');
			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => 0,
				'doc_code' 	=> '',
				'remark' 		=> "create new stock  pid=".$product_id
			);

			$this->model_log->create("po_log",$log_data);
			$product_data = $this->model_products->getData($product_id);
				
			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => $product_data["id"],
				'doc_code' 	=> $product_data["name"],
				'remark' 		=> "create new stock success pid=".$product_data["id"]
			);

			$this->model_log->create("po_log",$log_data);

			$on_stock=$this->input->post('qty');
			$on_remain=0;

				
			$items = array(
						'doc_date' => $doc_date,
						'po_id' => 0,
						'po_unit_id' =>  $product_data["po_unit_id"],
						'product_name' =>  $product_data["name"],
						'unit_name' =>   $product_data["unit_name"],
						'product_id' => $product_id,
						'qty' =>  $on_stock,
						'on_stock' => $on_stock,
						'rate' => $product_data["cost_price"] * $on_stock,
						'on_remain' => 0,
						'on_sale' => 0,
						'sale_amount' => 0,
						'move_type' => 0,
						'item_remark' => $this->input->post('item_remark'),
						'store_id' => $store_id,
						'user_id' => $user_id
					);

					$this->db->insert('po_item', $items);

					$item_id = $this->db->insert_id();
					//อ้างอินถึง รหัส รายการ
					$items_move = array(
						'doc_id' => $item_id,
						'user_id' => $user_id,
						'product_id' => $product_id,
						'store_id' => $store_id,
						'qty' => $on_stock
					);
					$this->db->insert('product_stock_move', $items_move);

						// now decrease the stock from the product
					$product_stock_data = $this->model_productstock->getProductStockData($product_id,$store_id);
					if ($product_stock_data==null || count(	$product_stock_data )==0){

						//เพิ่มสินค้าลงในสต็อก
						$insert_stock_data = array(
							'product_id' => $product_id,
							'store_id' => $store_id,
							'on_stock' => $on_stock
						);
						$this->db->insert('product_stock', $insert_stock_data);
						$log_data = array(
							'createby' => $this->session->userdata ('id'),
							'ip'  =>"",
							'doc_id'     => 0,
							'doc_code' 	=> "",
							'remark' 		=> "create new stock success pid=".$product_id
						);
			
						$this->model_log->create("po_log",$log_data);
			

					}else {
				
							

							$this->db->where('product_id', $product_id);
							$this->db->where('store_id', $store_id);
							$this->db->set('on_stock', 'on_stock+'.$on_stock, FALSE);
							$update_stock = $this->db->update('product_stock');
							$log_data = array(
								'createby' => $this->session->userdata ('id'),
								'ip'  =>"",
								'doc_id'     => $po_id,
								'doc_code' 	=> "",
								'remark' 		=> "update stock success pid=".$product_id
							);
				
							$this->model_log->create("po_log",$log_data);

					}
					
				
					
				return true;

			}

		catch (Exception $ex){

			return false;

		}
		return true;
	}

	public function addStockReturn($product_id)
	{
		$po_id=0;
		//ดึง user id และ รหัสสาขา
		$user_id = $this->session->userdata('id');
		$store_id = $this->session->userdata('store_id');
		$this->load->model('model_log');

		try {
		

			if ($store_id==0){
				throw new Exception("ไม่พบสาขา");
			}
	
			
			$doc_date=date("Y-m-d",strtotime("now"));


			$this->load->model('model_products');
			$this->load->model('model_productstock');
			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => 0,
				'doc_code' 	=> '',
				'remark' 		=> "create new stock  pid=".$product_id
			);

			$this->model_log->create("po_log",$log_data);
			$product_data = $this->model_products->getData($product_id);
				
			$log_data = array(
				'createby' => $this->session->userdata ('id'),
				'ip'  =>"",
				'doc_id'     => $product_data["id"],
				'doc_code' 	=> $product_data["name"],
				'remark' 		=> "create new stock success pid=".$product_data["id"]
			);

			$this->model_log->create("po_log",$log_data);

			$on_stock=$this->input->post('qty');
			$on_remain=$on_stock;

				
			$items = array(
						'doc_date' => $doc_date,
						'po_id' => 0,
						'po_unit_id' =>  $product_data["po_unit_id"],
						'product_name' =>  $product_data["name"],
						'unit_name' =>   $product_data["unit_name"],
						'product_id' => $product_id,
						'qty' =>  $on_stock,
						'on_stock' => $on_stock,
						'rate' => 0,
						'on_remain' => $on_remain,
						'on_sale' => 0,
						'sale_amount' => 0,
						'move_type' => 2,
						'item_remark' => $this->input->post('item_remark'),
						'store_id' => $store_id,
						'user_id' => $user_id
					);

					$this->db->insert('po_item', $items);

					$item_id = $this->db->insert_id();
					//อ้างอินถึง รหัส รายการ
					$items_move = array(
						'doc_id' => $item_id,
						'user_id' => $user_id,
						'product_id' => $product_id,
						'store_id' => $store_id,
						'qty' => $on_stock
					);
					$this->db->insert('product_stock_move', $items_move);

				
							
							$this->db->where('product_id', $product_id);
							$this->db->where('store_id', $store_id);
							$this->db->set('on_stock', 'on_stock-'.$on_stock, FALSE);
							$update_stock = $this->db->update('product_stock');
							$log_data = array(
								'createby' => $this->session->userdata ('id'),
								'ip'  =>"",
								'doc_id'     => $po_id,
								'doc_code' 	=> "",
								'remark' 		=> "update stock success pid=".$product_id
							);
				
							$this->model_log->create("po_log",$log_data);

					
					
				
					
				return true;

			}

		catch (Exception $ex){

			return false;

		}
		return true;
	}

	public function countOrderItem($po_id)
	{
		if ($po_id) {
			$sql = "SELECT * FROM po_item WHERE id = ?";
			$query = $this->db->query($sql, array($po_id));
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
				
			
				'order_note' => $this->input->post('order_note'),
				'order_date' => $this->input->post('order_date'),
				'user_id' => $user_id
			);

		
			$data['delivery_date'] = date("Y-m-d");
			

			$this->db->where('id', $id);
			$update = $this->db->update('po_head', $data);

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
			$this->db->where('po_id', $id);
			$this->db->delete('po_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
			for ($x = 0; $x < $count_product; $x++) {
				$items = array(
					'po_id' => $id,
					'product_id' => $this->input->post('product')[$x],
					'qty' => $this->input->post('qty')[$x],
					'rate' => $this->input->post('rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
				);
				$this->db->insert('po_item', $items);

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

			$this->db->where('po_id', $id);
			$delete_item = $this->db->delete('po_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidpo_head()
	{
		$sql = "SELECT * FROM po_head WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}
