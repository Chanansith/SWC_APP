<?php

class Model_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*getting the total months*/
	private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}

	/* getting the year of the orders */
	public function getOrderYear($shop)
	{
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		$result = $query->result_array();

		$return_data = array();
		foreach ($result as $k => $v) {
			$date = date('Y', $v['doc_date']);
			$return_data[] = $date;
		}

		$return_data = array_unique($return_data);

		return $return_data;
	}

	// getting the order reports based on the year and moths
	public function getOrderData($year, $report)
	{
		if ($year) {
			$months = $this->months();

			$sql = "SELECT * FROM orders WHERE paid_status = ?";
			$query = $this->db->query($sql, array(1));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year . '-' . $month_y;

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', $v['doc_date']);

					if ($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}


			return $final_data;
		}
	}

	public function getDateRange($date_range, $store_id)
	{
		$arraydata1 = explode("-", $date_range[0]);
		$arraydata2 = explode("-", $date_range[1]);

		$datetime1 = $arraydata1[2] . "-" . $arraydata1[0] . "-" . $arraydata1[1];
		$datetime2 = $arraydata2[2] . "-" . $arraydata2[0] . "-" . $arraydata2[1];

		$sql = "SELECT DATE_FORMAT(FROM_UNIXTIME(t2.doc_date), '%Y-%m-%d') AS orders_date, ";
		$sql .= "SUM(t1.amount) AS orders_sum FROM orders_item t1 ";
		$sql .= "LEFT JOIN orders t2 ON t1.order_id = t2.id ";
		if ($this->session->userdata('id') != 1) {
			$sql .= "LEFT JOIN products t3 ON t1.product_id = t3.id ";
		}
		if ($store_id != "") {
			$sql .= "LEFT JOIN products t3 ON t1.product_id = t3.id ";
		}
		$sql .= "WHERE DATE_FORMAT(FROM_UNIXTIME(t2.doc_date), '%Y-%m-%d') >= '" . $datetime1 . "' ";
		$sql .= " AND DATE_FORMAT(FROM_UNIXTIME(t2.doc_date), '%Y-%m-%d') <= '" . $datetime2 . "' ";
		if ($this->session->userdata('id') != 1) {
			$sql .= "AND t3.store_id = '" . $this->session->userdata('store') . "' ";
		}
		if ($store_id != "") {

			$sql .= " AND t3.store_id = '" . $store_id . "' ";
		}

		$sql .= "GROUP BY orders_date ";
		$sql .= "ORDER BY orders_date asc";
		//		echo $sql;
		// $sql += $this->db->where("orders_date >=", $date_range[0]);
		// $sql += $this->db->where("orders_date <=", $date_range[1]);
		// $sql += $this->db->group_by('orders_date');
		// $sql += $this->db->order_by('orders_date', 'desc');

		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function getProduct($store_id)
	{
		$sql = "SELECT t3.*, DATE_FORMAT(FROM_UNIXTIME(t2.doc_date), '%Y-%m-%d') AS orders_date, ";
		$sql .= "SUM(t1.amount) AS orders_sum FROM orders_item t1 ";
		$sql .= "LEFT JOIN orders t2 ON t1.order_id = t2.id LEFT JOIN products t3 ON t1.product_id = t3.id ";
		if ($this->session->userdata('id') != 1) {
			$sql .= "WHERE t3.store_id = '" . $this->session->userdata('store') . "' ";
		}
		if ($store_id != "") {
			$sql .= "WHERE t3.store_id = '" . $store_id . "' ";
		}
		$sql .= "GROUP BY t1.product_id";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function getStroe($store_id)
	{
		$sql = "select * from stores where id = '$store_id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function getallStroe()
	{
		$sql = "select * from stores";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function getSaleReport($date_range, $store_id)
	{
		$arraydata1 = explode("-", $date_range[0]);
		$arraydata2 = explode("-", $date_range[1]);

		$datetime1 = $arraydata1[2] . "-" . $arraydata1[0] . "-" . $arraydata1[1];
		$datetime2 = $arraydata2[2] . "-" . $arraydata2[0] . "-" . $arraydata2[1];

		$this->db->select('t1.*');
		$this->db->from('so_item t1');
		$this->db->join('products t2', 't1.product_id = t2.id');
		
		$this->db->where('DATE_FORMAT(t1.doc_date, "%Y-%m-%d") >=', $datetime1);
		$this->db->where('DATE_FORMAT(t1.doc_date, "%Y-%m-%d") <=', $datetime2);
		$this->db->where('t1.store_id', $store_id);
	
		$this->db->group_by('t1.id');

		$query = $this->db->get();
		$result = $query->result();

		//print_r($result);
		//print_r($this->db->last_query());
		return $result;
	}


	function getReceiveReport($date_range, $store_id,$category_id=0)
	{
		$arraydata1 = explode("-", $date_range[0]);
		$arraydata2 = explode("-", $date_range[1]);

		$datetime1 = $arraydata1[2] . "-" . $arraydata1[0] . "-" . $arraydata1[1];
		$datetime2 = $arraydata2[2] . "-" . $arraydata2[0] . "-" . $arraydata2[1];

		$this->db->select('t1.*,t2.cost_price,t2.sale_price');
		$this->db->from('po_item t1');
		$this->db->join('products t2', 't1.product_id = t2.id');
		
		$this->db->where('DATE_FORMAT(t1.doc_date, "%Y-%m-%d") >=', $datetime1);
		$this->db->where('DATE_FORMAT(t1.doc_date, "%Y-%m-%d") <=', $datetime2);
		$this->db->where('t1.store_id', $store_id);

		if ($category_id>0){
			$this->db->where('t2.category_id', $category_id);
		}
	
		$this->db->group_by('t1.id');

		$query = $this->db->get();
		$result = $query->result();

		//print_r($result);
		//print_r($this->db->last_query());
		return $result;
	}
	function getOrderItem($order_id)
	{
		if ($order_id) {
			$sql = "SELECT t1.order_id, t2.name FROM orders_item t1 LEFT JOIN products t2 ON t1.product_id = t2.id WHERE order_id = " . $order_id;
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
}
