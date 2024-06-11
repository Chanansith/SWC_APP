<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Report extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
        $this->load->model('car_model');
        $this->load->model('down_model');
        $this->load->model('debtor_model');
        // $this->load->model('farmer_model');
        // $this->load->model('language_model');
        $this->isLoggedIn();
    }
    function reportCost()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $this->loadViews("report/reportCost", $this->global, NULL, NULL);
        }
    }
    function reportCostList(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            // $carno = $this->input->post('carno');
            $type = $this->input->post('type');
            $data['type'] = $type;
            // if(!empty($carno)){
            //     $data['carRecords'] = $this->car_model->getCarById($carno);
            //     if($type === "1"){
            //         $day = $this->input->post('day');
            //         $data['carRecords']['conditionCost'] = $this->report_model->getConditionCost($carno,$day);
            //         $data['carRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCost($carno,$day);
            //         $data['day'] = $day;
            //     }else if($type === "2"){
            //         $month = $this->input->post('month');
            //         $data['carRecords']['conditionCost'] = $this->report_model->getConditionCost($carno,null,$month);
            //         $data['carRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCost($carno,null,$month);
            //         $data['month'] = $month;
            //     }else if($type === "3"){
            //         $year = $this->input->post('year');
            //         $data['carRecords']['conditionCost'] = $this->report_model->getConditionCost($carno,null,null,$year);
            //         $data['carRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCost($carno,null,null,$year);
            //         $data['year'] = $year;
            //     }
            // }else{
                if($type === "1"){
                    $day = $this->input->post('day');
                    $data['reportRecords']['conditionCost'] = $this->report_model->getConditionCostCar($day);
                    $data['reportRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCostCar($day);
                    $data['day'] = $day;
                }else if($type === "2"){
                    $month = $this->input->post('month');
                    $data['reportRecords']['conditionCost'] = $this->report_model->getConditionCostCar(null,$month);
                    $data['reportRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCostCar(null,$month);
                    $data['month'] = $month;
                }else if($type === "3"){
                    $year = $this->input->post('year');
                    // $carno = $this->input->post('carno');
                    // $data['carRecords'] = $this->car_model->getCarById($carno);
                    $data['reportRecords']['conditionCost'] = $this->report_model->getConditionCostCar(null,null,$year);
                    $data['reportRecords']['regisDepartCost'] = $this->report_model->getRegisDepartCostCar(null,null,$year);
                    $data['year'] = $year;
                }
            // }
            $this->global['pageTitle'] = 'Report';
            // echo json_encode($data);
            $this->loadViews("report/reportCostList", $this->global, $data, NULL);
        }
    }
    function reportDown(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->report_model->downListingCount($searchText);
            $returns = $this->paginationCompress("reportDown/", $count, 10);
            $data['downRecords'] = $this->report_model->downListing($searchText ,$returns["page"], $returns["segment"]);
            // $data['header'] = "Cost";
            foreach($data['downRecords'] as $record){
                $record->downPayRecords = $this->report_model->downPayListing($record->id);
            }
            $this->global['pageTitle'] = 'Down List';
            // echo json_encode($data['fixRecords']);
            $this->loadViews("report/reportDownList", $this->global, $data, NULL);
            // $this->loadViews("report/reportDown", $this->global, NULL, NULL);
        }
    }
    function reportDownList(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            // $id = $this->carId;
            // $searchText = $this->input->post('searchText');
            // $data['searchText'] = $searchText;
            // $type = $this->input->post('type');
            // $data['type'] = $type;
            // if($type === "1"){
            //     $day = $this->input->post('day');
            //     $data['reportDownRecords'] = $this->report_model->getDownList($day);
            //     $data['day'] = $day;
            // }else if($type === "2"){
            //     $month = $this->input->post('month');
            //     $data['reportDownRecords'] = $this->report_model->getDownList(null,$month);

            //     $data['month'] = $month;
            // }else if($type === "3"){
            //     $year = $this->input->post('year');
            //     // $carno = $this->input->post('carno');
            //     // $data['carRecords'] = $this->car_model->getCarById($carno);
            //     $data['reportDownRecords'] = $this->report_model->getDownList(null,null,$year);
            //     $data['year'] = $year;
            // }
            // $this->load->library('pagination');
            // $count = $this->report_model->downListingCount( $searchText);
            // $returns = $this->paginationCompress("down/", $count, 10);
            $data['downRecords'] = $this->report_model->downListing( );
            // $data['header'] = "Cost";
            foreach($data['downRecords'] as $record){
                $record->downPayRecords = $this->report_model->downPayListing($record->id);
            }
            $this->global['pageTitle'] = 'Down List';
            // echo json_encode($data['fixRecords']);
            $this->loadViews("report/reportDownList", $this->global, $data, NULL);
        }
    }
    function reportFix(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $this->loadViews("report/reportFix", $this->global, NULL, NULL);
        }
    }
    function reportFixList(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $type = $this->input->post('type');

            $data['type'] = $type;
    
            if($type === "1"){
                $day = $this->input->post('day');
                $reportRecords = $this->report_model->getFix();
                for ($i = 0; $i < count($reportRecords); $i++) {
                    $fixIn = $this->report_model->getfixIn($reportRecords[$i]->id,$day);
                    $fixOut = $this->report_model->getfixOut($reportRecords[$i]->id,$day);
                    if(count($fixIn)>0||count($fixOut)>0){
                        $data['reportRecords'][$i] = $reportRecords[$i];
                        $data['reportRecords'][$i]->fixIn = $fixIn;
                        $data['reportRecords'][$i]->fixOut = $fixOut;
                    }
                }
                $data['day'] = $day;
            }else if($type === "2"){
                $carno = $this->input->post('carno');
                $reportRecords = $this->report_model->getFix($carno);
                $month = $this->input->post('month');
                for ($i = 0; $i < count($reportRecords); $i++) {
                    $fixIn = $this->report_model->getfixIn($reportRecords[$i]->id,NULL,$month);
                    $fixOut = $this->report_model->getfixOut($reportRecords[$i]->id,NULL,$month);
                    if(count($fixIn)>0||count($fixOut)>0){
                        $data['reportRecords'][$i] = $reportRecords[$i];
                        $data['reportRecords'][$i]->fixIn = $fixIn;
                        $data['reportRecords'][$i]->fixOut = $fixOut;
                    }
                }
                $data['month'] = $month;
            }else if($type === "3"){
                $year = $this->input->post('year');
                $carnoyear = $this->input->post('carnoyear');
                $reportRecords = $this->report_model->getFix($carnoyear);

                for ($i = 0; $i < count($reportRecords); $i++) {
                    $fixIn = $this->report_model->getfixIn($reportRecords[$i]->id,NULL,NULL,$year);
                    $fixOut = $this->report_model->getfixOut($reportRecords[$i]->id,NULL,NULL,$year);
                    if(count($fixIn)>0||count($fixOut)>0){
                        $data['reportRecords'][$i] = $reportRecords[$i];
                        $data['reportRecords'][$i]->fixIn = $fixIn;
                        $data['reportRecords'][$i]->fixOut = $fixOut;
                    }
                }
                $data['year'] = $year;
            }
            $this->loadViews("report/reportFixList", $this->global, $data, NULL);
        }
    }
    function reportDebtor(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $this->loadViews("report/reportDebtor", $this->global, NULL, NULL);
        }
    }
    function reportDebtorList(){
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Report';
            $type = $this->input->post('type');
            $data['type'] = $type;
            // $searchText = $this->input->post('searchText');
            // $data['searchText'] = $searchText;
            
            if($type === "1"){
                $day = $this->input->post('day');
                $reportRecords = $this->report_model->debtorListing();
                for ($i = 0; $i < count($reportRecords); $i++) {
                    $tentPay = $this->report_model->debtorTentPayListing($reportRecords[$i]->id,$day);
                    $tentReceive = $this->report_model->debtorTentReceiveListing($reportRecords[$i]->id,$day);
                    if(count($tentPay)>0||count($tentReceive)>0){
                        $data['debtorRecords'][$i] = $reportRecords[$i];
                        $data['debtorRecords'][$i]->tentPay = $tentPay;
                        $data['debtorRecords'][$i]->tentReceive = $tentReceive;
                    }
                }
                $data['day'] = $day;
            }else if($type === "2"){
                $month = $this->input->post('month');
                $reportRecords = $this->report_model->debtorListing();
                for ($i = 0; $i < count($reportRecords); $i++) {
                    $tentPay = $this->report_model->debtorTentPayListing($reportRecords[$i]->id,null,$month);
                    $tentReceive = $this->report_model->debtorTentReceiveListing($reportRecords[$i]->id,null,$month);
                    if(count($tentPay)>0||count($tentReceive)>0){
                        $data['debtorRecords'][$i] = $reportRecords[$i];
                        $data['debtorRecords'][$i]->tentPay = $tentPay;
                        $data['debtorRecords'][$i]->tentReceive = $tentReceive;
                    }
                }
                $data['month'] = $month;
            }else if($type === "3"){
                $year = $this->input->post('year');
                $reportRecords = $this->report_model->debtorListing();
                for ($i = 0; $i < count($reportRecords); $i++) {
                    $tentPay = $this->report_model->debtorTentPayListing($reportRecords[$i]->id,null,null,$year);
                    $tentReceive = $this->report_model->debtorTentReceiveListing($reportRecords[$i]->id,null,null,$year);
                    if(count($tentPay)>0||count($tentReceive)>0){
                        $data['debtorRecords'][$i] = $reportRecords[$i];
                        $data['debtorRecords'][$i]->tentPay = $tentPay;
                        $data['debtorRecords'][$i]->tentReceive = $tentReceive;
                    }
                }
                $data['year'] = $year;
            }
            $this->loadViews("report/reportDebtorList", $this->global, $data, NULL);
        }
    }
    // function report_order(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //          $data['header'] = $this->language_model->getheaderreportorder();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Order';
    //         $data['customer'] = $this->report_model->getCustomer();
    //         $data['farmer'] = $this->report_model->getFarmer();
    //         $this->loadViews("report/report_order", $this->global, $data, NULL);
    //     }
    // }
    // function report_order_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $customer_id = $this->input->post('customer_id');
    //         $farmer_id = $this->input->post('farmer_id');
    //         $order_date = $this->input->post('order_date');
    //         $to_order_date = $this->input->post('to_order_date');
    //         $searchText = $this->input->post('searchText');

    //         $data['searchText'] = $searchText;
    //         $data['customer_id'] = $customer_id;
    //         $data['farmer_id'] = $farmer_id;
    //         $data['order_date'] = $order_date;
    //         $data['to_order_date'] = $to_order_date;

    //         // $this->load->library('pagination');
    //         // $count = $this->report_model->OrderListingCount($searchText,$customer_id, $farmer_id);
    //         // $returns = $this->paginationCompress("OrderListing/", $count, 15);

    //         // $data['OrderRecords'] = $this->report_model->OrderListing($searchText,$customer_id, $farmer_id, $returns["page"], $returns["segment"]);
    //         $data['header'] = $this->language_model->getheaderorder();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Order';

    //         $this->loadViews("report/report_order_list", $this->global, $data, NULL);
    //     }
    // }
    // function fetchDataReportOrderList(){
    //     $result = array('data' => array());
    //     $customer_id = $this->input->get('customer_id');
    //     if($customer_id == 0){
    //         $customer_id = null;
    //     }
    //     $farmer_id = $this->input->get('farmer_id');
    //     if($farmer_id == 0){
    //         $farmer_id = null;
    //     }
    //     $order_date = $this->input->get('order_date');
    //     $to_order_date = $this->input->get('to_order_date');
    //     $data = $this->report_model->getDataOrderList($customer_id,$farmer_id,$order_date,$to_order_date);
    //     $i = 0;
    //     if (!empty($data)) {
    //         foreach ($data as $key => $value) {
    //             $i++;
    //             $item = '';
    //             // $buttons .= '<a class="btn btn-sm btn-info" href="' . base_url("editOrderItem/" . $value['order_item_id']) . '"><i class="fa fa-pencil"></i></a>';
    //             // $buttons .= '<a class="btn btn-sm btn-danger deleteOrderItem" href="#" data-id="' . $value['order_item_id'] . '"><i class="fa fa-trash"></i></a>';
    //             $dataItem = $this->report_model->getDataOrderItemList($value['order_id']);
    //             foreach($dataItem as $value2){
    //                 $item .= $value2['product_name_la'].' '.$value2['product_name_en'].' จำนวน '.$value2['quantity'].' ราคา '.$value2['price'].' รวม '.$value2['total'].'<br/>';
    //             }
    //             if ($value['order_status'] == 1) {
    //                 $status = '<span class="label label-default">Waiting</span>';
    //             } else if ($value['order_status'] == 2) {
    //                 $status = '<span class="label label-info">Confirm</span>';
    //             } else if ($value['order_status'] == 3) {
    //                 $status = '<span class="label label-warning">Prepare</span>';
    //             } else if ($value['order_status'] == 4) {
    //                 $status = '<span class="label label-primary">Prepare Success</span>';
    //             } else if ($value['order_status'] == 5) {
    //                 $status = '<span class="label label-success">Successful</span>';
    //             } else if ($value['order_status'] == 6) {
    //                 $status = '<span class="label label-danger">Cancel</span>';
    //             } else {
    //                 $status = '';
    //             }
    //             $result['data'][$key] = array(
    //                 $i,
    //                 $value['first_name'] . " " . $value['last_name'] . " " .$value['first_name_farmer'] . " " . $value['last_name_farmer'],
    //                 $value['order_date'],
    //                 $value['delivery_deadline'],
    //                 $status,
    //                 $value['shipping_address'],
    //                 $value['total_amount'],
    //                 $item
    //                 // $buttons
    //             );
    //         } // /foreach
    //     }
    //     // echo json_encode(array('customer'=>$customer_id,'farmer'=>$farmer_id));
    //     echo json_encode($result);
    // }
    // function report_order_platform_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $customer_id = $this->input->post('customer_id_platform');
    //         $farmer_id = $this->input->post('farmer_id_platform');
    //         $order_date = $this->input->post('order_date_platform');
    //         $to_order_date = $this->input->post('to_order_date_platform');
    //         $searchText = $this->input->post('searchText');

    //         $data['searchText'] = $searchText;
    //         $data['customer_id'] = $customer_id;
    //         $data['farmer_id'] = $farmer_id;
    //         $data['order_date'] = $order_date;
    //         $data['to_order_date'] = $to_order_date;
    //         $data['header'] = $this->language_model->getheaderorder();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Order Platform';

    //         $this->loadViews("report/report_order_platform_list", $this->global, $data, NULL);
    //     }
    // }
    // public function fetchDataReportOrderPlatformList()
    // {
    //     $result = array('data' => array());

    //     $customer_id = $this->input->get('customer_id');
    //     if($customer_id == 0){
    //         $customer_id = null;
    //     }
    //     $farmer_id = $this->input->get('farmer_id');
    //     if($farmer_id == 0){
    //         $farmer_id = null;
    //     }
    //     $order_date = $this->input->get('order_date');
    //     $to_order_date = $this->input->get('to_order_date');
    //     $data = $this->report_model->getDataOrderPlatformList($customer_id,$farmer_id,$order_date,$to_order_date);
    //     $i = 0;
    //     if (!empty($data)) {
    //         foreach ($data as $key => $value) {
    //             $i++;
    //             $item = '';
    //             // $buttons .= '<a class="btn btn-sm btn-info" href="' . base_url("editOrderItem/" . $value['order_item_id']) . '"><i class="fa fa-pencil"></i></a>';
    //             // $buttons .= '<a class="btn btn-sm btn-danger deleteOrderItem" href="#" data-id="' . $value['order_item_id'] . '"><i class="fa fa-trash"></i></a>';
    //             $dataItem = $this->report_model->getDataOrderPlatformItemList($value['order_id']);
    //             if(!empty($dataItem)){
    //                 foreach($dataItem as $value2){
    //                     $item .= $value2['product_name_la'].' '.$value2['product_name_en'].' จำนวน '.$value2['quantity'].' ราคา '.$value2['price'].' รวม '.$value2['total'].'<br/>';
    //                 }
    //             }
    //             if ($value['order_status'] == 1) {
    //                 $status = '<span class="label label-default" id="'.$value['order_id'].'">Waiting</span>';
    //             } else if ($value['order_status'] == 2) {
    //                 $status = '<span class="label label-info">Confirm</span>';
    //             } else if ($value['order_status'] == 3) {
    //                 $status = '<span class="label label-warning">Prepare</span>';
    //             } else if ($value['order_status'] == 4) {
    //                 $status = '<span class="label label-primary">Prepare Success</span>';
    //             } else if ($value['order_status'] == 5) {
    //                 $status = '<span class="label label-success">Successful</span>';
    //             } else if ($value['order_status'] == 6) {
    //                 $status = '<span class="label label-danger">Cancel</span>';
    //             } else {
    //                 $status = '';
    //             }
    //             $result['data'][$key] = array(
    //                 $i,
    //                 $value['first_name'] . " " . $value['last_name'] . " " .$value['first_name_farmer'] . " " . $value['last_name_farmer'],
    //                 $value['order_date'],
    //                 $value['delivery_deadline'],
    //                 $status,
    //                 $value['shipping_address'],
    //                 $value['total_amount'],
    //                 $item
    //                 // $buttons
    //             );
    //         } // /foreach
    //     }

    //     echo json_encode($result);
    // }
    // function report_sign()
    // {
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $data['customer'] = $this->order_model->getCustomer();
    //         $data['header'] = $this->language_model->getHeaderReport_sign_search();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Sign';

    //         $this->loadViews("report/sign_search", $this->global, $data, NULL);
    //     }
    // }
    // function report_sign_list()
    // {
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $searchText = $this->input->post('searchText');
    //         $customer_id = $this->input->post('customer_id');
    //         $contract_number = $this->input->post('contract_number');
    //         $contract_date = $this->input->post('contract_date');
    //         $data['searchText'] = $searchText;
    //         $data['customer_id'] = $customer_id;
    //         $data['contract_number'] = $contract_number;
    //         $data['contract_date'] = $contract_date;

    //         $this->load->library('pagination');
    //         $count = $this->report_model->signListingCount($searchText,$customer_id, $contract_number,$contract_date);
    //         $returns = $this->paginationCompress("signListing/", $count, 15);

    //         $data['signRecords'] = $this->report_model->signListing($searchText,$customer_id, $contract_number,$contract_date, $returns["page"], $returns["segment"]);
    //          $data['header'] = $this->language_model->getheadercontactrec();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Sign';

    //         $this->loadViews("report/sign", $this->global, $data, NULL);
    //     }
    // }
    // function getimage_sign(){
    //     $id = $this->input->post('id');
    //     $result = $this->report_model->getimage_sign($id);
    //     echo json_encode($result);
    // }
    // function report_agriculture(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $data['farmer'] = $this->farmer_model->farmerListing();
    //         $data['header'] = $this->language_model->getheaderagriculture();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Agriculture';

    //         $this->loadViews("report/agriculture_search", $this->global, $data, NULL);
    //     }
    // }
    // function report_agriculture_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $searchText = $this->input->post('searchText');
    //         $farmer_id = $this->input->post('farmer_id');
    //         $data['searchText'] = $searchText;
    //         $data['farmer_id'] = $farmer_id;

    //         $this->load->library('pagination');
    //         $count = $this->report_model->farmerListingCount($searchText,$farmer_id);
    //         $returns = $this->paginationCompress("farmerListing/", $count, 15);

    //         $data['farmerRecords'] = $this->report_model->farmerListing($searchText,$farmer_id, $returns["page"], $returns["segment"]);
    //         $data['header'] = $this->language_model->getheaderfarmer();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Agriculture';

    //         $this->loadViews("report/agriculture", $this->global, $data, NULL);
    //     }
    // }
    // function report_farmer_income(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $data['farmer'] = $this->farmer_model->farmerListing();
    //         $data['header'] = $this->language_model->getheaderagriculture();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Farmer Income';

    //         $this->loadViews("report/farmer_income_search", $this->global, $data, NULL);
    //     }
    // }
    // function report_farmer_income_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $searchText = $this->input->post('searchText');
    //         $farmer_id = $this->input->post('farmer_id');
    //         $data['searchText'] = $searchText;
    //         $data['farmer_id'] = $farmer_id;

    //         $this->load->library('pagination');
    //         $count = $this->report_model->farmerListingCount($searchText,$farmer_id);
    //         $returns = $this->paginationCompress("farmerListing/", $count, 15);

    //         $data['farmerRecords'] = $this->report_model->farmerListing($searchText,$farmer_id, $returns["page"], $returns["segment"]);
    //         $data['header'] = $this->language_model->getheaderfarmer();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Farmer Income';

    //         $this->loadViews("report/farmer_income", $this->global, $data, NULL);
    //     }
    // }

    // function report_customer(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $data['customer'] = $this->order_model->getCustomer();
    //         $data['farmer'] = $this->report_model->getFarmer(); 
    //         $data['header'] = $this->language_model->headersearchcustomer();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Customer';

    //         $this->loadViews("report/customer_search", $this->global, $data, NULL);
    //     }
    // }
    // function report_customer_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $searchText = $this->input->post('searchText');
    //         $customer_id = $this->input->post('customer_id');
    //         $data['searchText'] = $searchText;
    //         $data['customer_id'] = $customer_id;

    //         $this->load->library('pagination');
    //         $count = $this->report_model->customerListingCount($searchText,$customer_id);
    //         $returns = $this->paginationCompress("customerListing/", $count, 15);

    //         $data['customerRecords'] = $this->report_model->customerListing($searchText,$customer_id, $returns["page"], $returns["segment"]);
    //         $data['header'] = $this->language_model->getheaderCustomer();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Customer';

    //         $this->loadViews("report/report_customer_list", $this->global, $data, NULL);
    //     }
    // }
    // function report_farmer_list(){
    //     if ($this->isAdmin() == TRUE) {
    //         $this->loadThis();
    //     } else {
    //         $searchText = $this->input->post('searchText');
    //         $farmer_id = $this->input->post('farmer_id');
    //         $data['searchText'] = $searchText;
    //         $data['farmer_id'] = $farmer_id;

    //         $this->load->library('pagination');
    //         $count = $this->report_model->farmerListingCount($searchText,$farmer_id);
    //         $returns = $this->paginationCompress("farmerListing/", $count, 15);

    //         $data['farmerRecords'] = $this->report_model->farmerListing($searchText,$farmer_id, $returns["page"], $returns["segment"]);
    //         $data['header'] = $this->language_model->getheaderCustomer();
    //         $data['language'] = $this->language;
    //         $this->global['pageTitle'] = 'Report Customer';

    //         $this->loadViews("report/report_farmer_list", $this->global, $data, NULL);
    //     }
    // }
}
