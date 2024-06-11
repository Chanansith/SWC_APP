<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
    function getReportByday($carno = null, $day = null, $month = null, $year = null)
    {
        $this->db->select('t2.transfer_date as con_date,t2.condition_fee as con_condition_fee,t2.head_fee as con_head_fee,t2.edit_cost as con_edit_cost,t2.cent_cost as con_cent_cost,t2.enginer_cost as con_enginer_cost,t2.other as con_other,t2.inspection_fee as con_inspection_fee,
        t3.transfer_date as regis_date,t3.regis_fee as regis_regis_fee,t3.regis_pay_move as regis_regis_pay_move,t3.regis_pay_tranfer as regis_regis_pay_tranfer,t3.regis_pay_storage as regis_regis_pay_storage,t3.other as regis_other,');
        $this->db->from('cost_car t1');
        $this->db->join("condition_cost t2", "t1.id=t2.cost_car_id", "left");
        $this->db->join("cost_regis_depart t3", "t1.id=t3.cost_car_id", "left");
        // $this->db->join("cars t4", "t1.carno=t4.carno", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%'
                            OR  t3.transfer_date  LIKE '%" . $day . "%'
                            )";
            $this->db->where($likeCriteria);
        }
        if (!empty($carno)) {
            $this->db->where('t1.carno', $carno);
        }
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getConditionCost($carno = null, $day = null, $month = null, $year = null){
        $this->db->select('t2.transfer_date,t2.condition_fee,t2.head_fee,t2.edit_cost,t2.cent_cost,t2.enginer_cost,t2.other,t2.inspection_fee');
        $this->db->from('cost_car t1');
        $this->db->join("condition_cost t2", "t1.id=t2.cost_car_id", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($month)){
            $this->db->where('MONTH(t2.transfer_date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t2.transfer_date)', $year);
        }
        if (!empty($carno)) {
            $this->db->where('t1.carno', $carno);
        }
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getRegisDepartCost($carno = null, $day = null, $month = null, $year = null){
        $this->db->select(' t2.transfer_date,t2.regis_fee,t2.regis_pay_move,t2.regis_pay_tranfer,t2.regis_pay_storage,t2.other');
        $this->db->from('cost_car t1');
        $this->db->join("cost_regis_depart t2", "t1.id=t2.cost_car_id", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($month)){
            $this->db->where('MONTH(t2.transfer_date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t2.transfer_date)', $year);
        }
        if (!empty($carno)) {
            $this->db->where('t1.carno', $carno);
        }
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getConditionCostCar( $day = null, $month = null, $year = null){
        $this->db->select('t2.transfer_date,t2.condition_fee,t2.head_fee,t2.edit_cost,t2.cent_cost,t2.enginer_cost,t2.other,t2.inspection_fee,
        t3.model,t3.registerno');
        $this->db->from('cost_car t1');
        $this->db->join("condition_cost t2", "t1.id=t2.cost_car_id", "left");
        $this->db->join("cars t3", "t1.carno=t3.carno", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($month)){
            $this->db->where('MONTH(t2.transfer_date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t2.transfer_date)', $year);
        }

        $this->db->where('t1.is_delete', 0);
        $this->db->where('t2.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getRegisDepartCostCar( $day = null, $month = null, $year = null){
        $this->db->select(' t2.transfer_date,t2.regis_fee,t2.regis_pay_move,t2.regis_pay_tranfer,t2.regis_pay_storage,t2.other,t3.model,t3.registerno');
        $this->db->from('cost_car t1');
        $this->db->join("cost_regis_depart t2", "t1.id=t2.cost_car_id", "left");
        $this->db->join("cars t3", "t1.carno=t3.carno", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($month)){
            $this->db->where('MONTH(t2.transfer_date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t2.transfer_date)', $year);
        }
  
        $this->db->where('t1.is_delete', 0);
        $this->db->where('t2.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function downListingCount($searchText = '')
    {
        $this->db->select('t1.id,t1.down_balance,t2.custname,t2.registerno,t2.model,t3.branchname');
        $this->db->from('down t1');
        $this->db->join('cars t2', 't1.carno = t2.carno','left');
        $this->db->join("branch t3", "t3.branchno=t2.brandno","left");
        if(!empty($searchText)) {
            $likeCriteria = "(t2.custname   LIKE '%".$searchText."%'
                            OR  t2.registerno   LIKE '%".$searchText."%'
                            OR  t2.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');

        $query = $this->db->get();
        return count($query->result());
    }
    function downListing($searchText = '',$page = 0, $segment = 0)
    {
        $this->db->select('t1.id,t1.down_balance,t2.custname,t2.registerno,t2.model,t3.branchname');
        $this->db->from('down t1');
        $this->db->join('cars t2', 't1.carno = t2.carno','left');
        $this->db->join("branch t3", "t3.branchno=t2.brandno","left");
        if(!empty($searchText)) {
            $likeCriteria = "(t2.custname   LIKE '%".$searchText."%'
                            OR  t2.registerno   LIKE '%".$searchText."%'
                            OR  t2.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->limit($page, $segment);
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function downPayListing($id){
        $this->db->select('t1.id,t1.transfer_date,t1.evidence,t1.cost,t1.type');
        $this->db->from('downPay t1');
        $this->db->where('t1.downId ', $id);
        $this->db->where('t1.is_delete ', 0);
        $query = $this->db->get();

        return $query->result();
    }
    function getDownList($day = null, $month = null, $year = null){
        $this->db->select('t1.down_balance,t2.cost,t2.type,t3.custname,t3.model,t3.registerno');
        $this->db->from('down t1');
        $this->db->join("downPay t2", "t1.id=t2.downId", "left");
        $this->db->join("cars t3", "t1.carno=t3.carno", "left");
        if (!empty($day)) {
            $likeCriteria = "(t2.transfer_date  LIKE '%" . $day . "%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($month)){
            $this->db->where('MONTH(t2.transfer_date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t2.transfer_date)', $year);
        }
  
        $this->db->where('t1.is_delete', 0);
        $this->db->where('t2.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getFix($carno = null){
        $this->db->select('t1.id,t1.carno,t2.model,t2.registerno');
        $this->db->from('fix_car t1');
        $this->db->join('cars t2', 't1.carno = t2.carno','left');
        if(!empty($carno)){
            $this->db->where('t1.carno', $carno);
        }
        $this->db->where('t1.is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getfixIn($fix_car_id = null,$day = null, $month = null, $year = null){
        $this->db->select('id,fix_car_id,date,list,cost,vat');
        $this->db->from('fix_car_in');
        if (!empty($day)) {
            $this->db->where("date  LIKE '%" . $day . "%'");
        }
        if(!empty($month)){
            $this->db->where('MONTH(date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(date)', $year);
        }
        if(!empty($fix_car_id)){
            $this->db->where('fix_car_id', $fix_car_id);
        }
        $this->db->where('is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function getfixOut($fix_car_id = null,$day = null, $month = null, $year = null){
        $this->db->select('id,fix_car_id,date,list,cost,vat');
        $this->db->from('fix_car_out');
        if (!empty($day)) {
            $this->db->where("date  LIKE '%" . $day . "%'");
        }
        if(!empty($month)){
            $this->db->where('MONTH(date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(date)', $year);
        }
        if(!empty($fix_car_id)){
            $this->db->where('fix_car_id', $fix_car_id);
        }
        $this->db->where('is_delete', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function debtorListing(){
        $this->db->select('t1.id,t2.custname,t2.preparebank,t2.registerno,t2.model,t3.branchname');
        $this->db->from('debtor t1');
        $this->db->join('cars t2', 't1.carno = t2.carno','left');
        $this->db->join("branch t3", "t3.branchno=t2.brandno","left");

        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function debtorTentPayListing($id,$day=null,$month=null,$year=null){
        $this->db->select('t1.id,t1.date,t1.cost');
        $this->db->from('debtor_tent_pay t1');
        if (!empty($day)) {
            $this->db->where("t1.date  LIKE '%" . $day . "%'");
        }
        if(!empty($month)){
            $this->db->where('MONTH(t1.date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t1.date)', $year);
        }
        $this->db->where('t1.debtor_id', $id);
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');
 
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function debtorTentReceiveListing($id,$day=null,$month=null,$year=null){
        $this->db->select('t1.id,t1.date,t1.cost,t1.type,t1.evidence');
        $this->db->from('debtor_tent_receive t1');
        if (!empty($day)) {
            $this->db->where("t1.date  LIKE '%" . $day . "%'");
        }
        if(!empty($month)){
            $this->db->where('MONTH(t1.date)', $month);
        }
        if(!empty($year)){
            $this->db->where('YEAR(t1.date)', $year);
        }
        $this->db->where('t1.debtor_id', $id);
        $this->db->where('t1.is_delete', 0);
        $this->db->order_by('t1.id', 'desc');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    // function signListingCount($searchText = '',$customer_id = '',$contract_number = '',$contract_date = '')
    // {
    //     $this->db->select('t1.*,t2.first_name,t2.last_name');
    //     $this->db->from('Contracts t1');
    //     $this->db->join("customer t2", "t1.customer_id=t2.customer_id", "left");
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(t2.first_name  LIKE '%" . $searchText . "%'
    //                         OR  t2.last_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.admin_id  LIKE '%" . $searchText . "%'
    //                         OR  t1.contract_number  LIKE '%" . $searchText . "%'
    //                         OR  t1.customer_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.witness1_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.witness2_name  LIKE '%" . $searchText . "%'
    //                         )";
    //         $this->db->where($likeCriteria);
    //     }
    //     $this->db->where('t1.is_deleted', 0);
    //     $this->db->order_by('t1.contract_id', 'desc');
    //     if (!empty($customer_id)) {
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if (!empty($contract_number)) {
    //         $this->db->where('t1.contract_number', $contract_number);
    //     }
    //     if (!empty($contract_date)) {
    //         $this->db->where('t1.contract_date', $contract_date);
    //     }
    //     $query = $this->db->get();

    //     return count($query->result());
    // }

    // function signListing($searchText = '',$customer_id = '',$contract_number = '',$contract_date = '', $page = 0, $segment = 0)
    // {
    //     $this->db->select('t1.*,t2.first_name,t2.last_name');
    //     $this->db->from('Contracts t1');
    //     $this->db->join("customer t2", "t1.customer_id=t2.customer_id", "left");
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(t2.first_name  LIKE '%" . $searchText . "%'
    //                         OR  t2.last_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.admin_id  LIKE '%" . $searchText . "%'
    //                         OR  t1.contract_number  LIKE '%" . $searchText . "%'
    //                         OR  t1.customer_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.witness1_name  LIKE '%" . $searchText . "%'
    //                         OR  t1.witness2_name  LIKE '%" . $searchText . "%'
    //                         )";
    //         $this->db->where($likeCriteria);
    //     }
    //     $this->db->where('t1.is_deleted', 0);
    //     $this->db->order_by('t1.contract_id', 'desc');
    //     if (!empty($customer_id)) {
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if (!empty($contract_number)) {
    //         $this->db->where('t1.contract_number', $contract_number);
    //     }
    //     if (!empty($contract_date)) {
    //         $this->db->where('t1.contract_date', $contract_date);
    //     }
    //     $this->db->limit($page, $segment);
    //     $query = $this->db->get();

    //     $result = $query->result();
    //     return $result;
    // }
    // function getimage_sign($id){
    //     $this->db->select('contract_image');
    //     $this->db->from('Contracts');
    //     $this->db->where('contract_id', $id);
    //     $query = $this->db->get();

    //     return $query->row_array();
    // }
    // function farmerListingCount($searchText = '',$farmer_id='')
    // {
    //     $this->db->select('*');
    //     $this->db->from('Farmer');
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
    //                         OR  last_name  LIKE '%" . $searchText . "%'
    //                         OR  id_card  LIKE '%" . $searchText . "%'
    //                         OR  issue_date  LIKE '%" . $searchText . "%'
    //                         OR  exp_date  LIKE '%" . $searchText . "%'
    //                         OR  id_card_farmer  LIKE '%" . $searchText . "%'
    //                         OR  birthdate  LIKE '%" . $searchText . "%'
    //                         OR  phone  LIKE '%" . $searchText . "%')";

    //         $this->db->where($likeCriteria);
    //     }
    //     $this->db->where('isdelete', 0);
    //     $this->db->where('farmer_id', $farmer_id);
    //     $query = $this->db->get();

    //     return count($query->result());
    // }

    // function farmerListing($searchText = '',$farmer_id='', $page = 0, $segment = 0)
    // {
    //     $this->db->select('*');
    //     $this->db->from('Farmer');
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(first_name  LIKE '%" . $searchText . "%'
    //                         OR  last_name  LIKE '%" . $searchText . "%'
    //                         OR  id_card  LIKE '%" . $searchText . "%'
    //                         OR  issue_date  LIKE '%" . $searchText . "%'
    //                         OR  exp_date  LIKE '%" . $searchText . "%'
    //                         OR  id_card_farmer  LIKE '%" . $searchText . "%'
    //                         OR  birthdate  LIKE '%" . $searchText . "%'
    //                         OR  phone  LIKE '%" . $searchText . "%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     $this->db->where('isdelete', 0);
    //     $this->db->where('farmer_id', $farmer_id);
    //     $this->db->limit($page, $segment);
    //     $query = $this->db->get();

    //     $result = $query->result();
    //     return $result;
    // }
    // function getCustomer(){
    //     $this->db->select('customer_id,first_name,last_name');
    //     $this->db->from('customer');
    //     $this->db->where('is_deleted', 0);
    //     $query = $this->db->get();

    //     return $query->result();
    // }
    // function getFarmer(){
    //     $this->db->select('farmer_id,first_name,last_name');
    //     $this->db->from('Farmer');
    //     $this->db->where('isdelete', 0);
    //     $query = $this->db->get();

    //     return $query->result();
    // }
    // function OrderListingCount($searchText = '',$customer_id, $farmer_id){
    //     $this->db->select('t1.*,t2.first_name,t2.last_name,t3.first_name as first_name_farmer,t3.last_name as last_name_farmer');
    //     $this->db->from('Orders t1');
    //     $this->db->join('customer t2', 't1.customer_id = t2.customer_id', 'left');
    //     $this->db->join("Farmer t3", "t1.farmer_id=t2.farmer_id", "left");
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(t1.order_date  LIKE '%" . $searchText . "%'
    //                         OR  t1.order_status  LIKE '%" . $searchText . "%'
    //                         OR  t1.shipping_address  LIKE '%" . $searchText . "%'
    //                         OR  t1.total_amount  LIKE '%" . $searchText . "%'
    //                         OR  t2.first_name  LIKE '%" . $searchText . "%'
    //                         OR  t2.last_name  LIKE '%" . $searchText . "%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if($customer_id){
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if($farmer_id){
    //         $this->db->where('t1.farmer_id', $farmer_id);
    //     }
    //     $this->db->where('t1.is_deleted', 0);
    //     $query = $this->db->get();

    //     return count($query->result());
    // }
    // function OrderListing($searchText = '',$customer_id, $farmer_id, $page = 0, $segment = 0){
    //     $this->db->select('t1.*,t2.first_name,t2.last_name,t3.first_name as first_name_farmer,t3.last_name as last_name_farmer');
    //     $this->db->from('Orders t1');
    //     $this->db->join('customer t2', 't1.customer_id = t2.customer_id', 'left');
    //     $this->db->join("Farmer t3", "t1.farmer_id=t2.farmer_id", "left");
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(t1.order_date  LIKE '%" . $searchText . "%'
    //                         OR  t1.order_status  LIKE '%" . $searchText . "%'
    //                         OR  t1.shipping_address  LIKE '%" . $searchText . "%'
    //                         OR  t1.total_amount  LIKE '%" . $searchText . "%'
    //                         OR  t2.first_name  LIKE '%" . $searchText . "%'
    //                         OR  t2.last_name  LIKE '%" . $searchText . "%'
    //                         OR  t3.first_name  LIKE '%" . $searchText . "%'
    //                         OR  t3.last_name  LIKE '%" . $searchText . "%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if($customer_id){
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if($farmer_id){
    //         $this->db->where('t1.farmer_id', $farmer_id);
    //     }
    //     $this->db->where('t1.is_deleted', 0);
    //     $this->db->limit($page, $segment);
    //     $query = $this->db->get();

    //     $result = $query->result();
    //     return $result;
    // }
    // function getDataOrderList($customer_id,$farmer_id,$order_date,$to_order_date){
    //     $this->db->select('t1.*,t2.first_name,t2.last_name,t3.first_name as first_name_farmer,t3.last_name as last_name_farmer');
    //     $this->db->from('Orders t1');
    //     $this->db->join('customer t2', 't1.customer_id = t2.customer_id', 'left');
    //     $this->db->join("Farmer t3", "t1.farmer_id=t3.farmer_id", "left");
    //     $this->db->where('t1.is_deleted', 0);
    //     if( $customer_id){
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if( $farmer_id){
    //         $this->db->where('t1.farmer_id', $farmer_id);
    //     }
    //     if( $order_date){
    //         $this->db->where('t1.order_date >=', $order_date);
    //     }
    //     if( $to_order_date){
    //         $this->db->where('t1.order_date <=', $to_order_date);
    //     }
    //     $query = $this->db->get();

    //     $result = $query->result_array();
    //     return $result;
    // }
    // function getDataOrderPlatformList($customer_id,$farmer_id,$order_date,$to_order_date){
    //     $this->db->select('t1.*,t2.first_name,t2.last_name,t3.first_name as first_name_farmer,t3.last_name as last_name_farmer');
    //     $this->db->from('Orders_platform t1');
    //     $this->db->join('customer t2', 't1.customer_id = t2.customer_id', 'left');
    //     $this->db->join("Farmer t3", "t1.farmer_id=t3.farmer_id", "left");
    //     $this->db->where('t1.is_deleted', 0);
    //     if( $customer_id){
    //         $this->db->where('t1.customer_id', $customer_id);
    //     }
    //     if( $farmer_id){
    //     $this->db->where('t1.farmer_id', $farmer_id);
    // }
    // if( $order_date){
    //     $this->db->where('t1.order_date >=', $order_date);
    // }
    // if( $to_order_date){
    //     $this->db->where('t1.order_date <=', $to_order_date);
    // }
    //     $query = $this->db->get();

    //     $result = $query->result_array();
    //     return $result;
    // }
    // function getDataOrderItemList($id){
    //     $sql = " t1.*,t2.product_name_en,t2.product_name_la";

    //     $this->db->select($sql);
    //     $this->db->from("OrderItems t1");
    //     $this->db->join("ProductName t2", "t1.product_id=t2.product_id", "left");
    //     if ($id) {

    //         $this->db->where('t1.order_id', $id);
    //     }
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    // function getDataOrderPlatformItemList($id){
    //     $sql = " t1.*,t2.product_name_en,t2.product_name_la";

    //     $this->db->select($sql);
    //     $this->db->from("OrderItems_platform t1");
    //     $this->db->join("ProductPlatform t2", "t1.product_id=t2.product_id", "left");
    //     if ($id) {
    //         $this->db->where('t1.order_id', $id);
    //     }
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    // function customerListingCount($searchText = '',$customer_id=""){
    //     $this->db->select('*');
    //     $this->db->from('customer ');
    //     if(!empty($searchText)) {
    //         $likeCriteria = "(id_card_number   LIKE '%".$searchText."%'
    //                         OR  first_name   LIKE '%".$searchText."%'
    //                         OR  last_name  LIKE '%".$searchText."%'
    //                         OR  gender LIKE '%".$searchText."%'
    //                         OR  nationality LIKE '%".$searchText."%'
    //                         OR  address  LIKE '%".$searchText."%'
    //                         OR  customer_type LIKE '%".$searchText."%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if($customer_id){
    //         $this->db->where('customer_id ', $customer_id);
    //     }
    //     $this->db->where('is_deleted ', 0);
    //     $query = $this->db->get();

    //     return count($query->result());
    // }
    // function customerListing($searchText = '',$customer_id="", $page = 0, $segment = 0){
    //     $this->db->select('*');
    //     $this->db->from('customer');
    //     if(!empty($searchText)) {
    //         $likeCriteria = "(id_card_number   LIKE '%".$searchText."%'
    //                         OR  first_name   LIKE '%".$searchText."%'
    //                         OR  last_name  LIKE '%".$searchText."%'
    //                         OR  gender LIKE '%".$searchText."%'
    //                         OR  nationality LIKE '%".$searchText."%'
    //                         OR  address  LIKE '%".$searchText."%'
    //                         OR  customer_type LIKE '%".$searchText."%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if($customer_id){
    //         $this->db->where('customer_id ', $customer_id);
    //     }
    //     $this->db->where('is_deleted ', 0);
    //     $this->db->limit($page, $segment);
    //     $query = $this->db->get();

    //     $result = $query->result();        
    //     return $result;
    // }

}
