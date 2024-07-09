
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> สัญญาจัดเก็บมูลฝอยติดเชื้อ:Contract for disposal IMW 
            <small>Payment</small>
        </h1>
        <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Contract</a></li>
    </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Payment : สัญญาจัดเก็บมูลฝอยติดเชื้อ:Contract for disposal IMW</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addContract" action="<?php echo base_url_api ?>sourceuser/createpayment" method="post" role="form" >
                       
                        <input type="hidden" name="contract_id" value="<?php  echo $contract_id; ?>" />

                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">วันที่</label>
                                        <input type="text" class="form-control date" id="pay_date" name="pay_date" required >
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                             
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">สัญญาเลขที่</label>
                                        <input type="text" class="form-control required" id="contract_code" name="contract_code" readonly value="<?php echo($contract_code)?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="address">ราคาค่าขนส่ง/ค่าจัดเก็บ</label>
                                       <input type="number" class="form-control required" id="ship_price" name="ship_price" value="<?php echo(number_format($contract->ship_price,2))?>" readonly>
                                   </div>
                               </div>
                           </div>
                            <div class="row">
                               
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="address">ปริมาณขยะ</label>
                                       <input type="number" class="form-control required" id="disposal_qty" name="disposal_qty" value="<?php echo(number_format($contract->disposal_qty,2))?>" readonly>
                                   </div>
                               </div>
                           </div>
                            <div class="row">
                               
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="address">จำนวนเงินต่อสัญญา</label>
                                       <input type="number" class="form-control required" id="amount_per_contract" name="amount_per_contract" value="0">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="address">เลือกธนาคาร</label>
                                      <select class="form-control required" id="bank_id" name="bank_id" required>
                                        <option value="0">เลือกธนาคาร</option>
                                        <option value="1">ไทยพานิชย์</option>
                                        <option value="2">กสิกรไทย</option>
                                      </select>
                               </div>
                           </div>
                           </div>
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">จำนวนเงินที่จ่าย</label>
                                        <input type="number" class="form-control required" id="pay_amount" name="pay_amount" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">จำนวนเงินที่เหลือ</label>
                                        <input type="number" class="form-control required" id="remain_amount" name="remain_amount" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="address">แนบหลักฐานการจ่ายบิล</label>
                                      <input type="file" class="form-control required" id="attach_file" name="attach_file">
                                  </div>
                              </div>
                          </div>
                            <div class="row">
                              
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">เจ้าหน้าที่ผู้จ่ายบิล</label>
                                        <input type="text" class="form-control required" id="payment_by" name="payment_by">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="address">รายละเอียดอื่นๆ</label>
                                      <textarea rows="5" class="form-control" name="other_detail"></textarea>
                                  </div>
                              </div>
                          </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-warning" value="Preview Data" />
                            <input type="submit" class="btn btn-warning" value="Submit" />
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/jquery.datetimepicker.css">
<script type="text/javascript" src="<?= base_url()?>assets/jquery.datetimepicker.js"></script>
<script>
    jQuery('#pay_date').datetimepicker({
      timepicker:false,
      format:'Y-m-d',
      lang:'en'
    });
    var ship_pric=0;
    var disposal_qty=0;
function calTotal(){
    console.log("cal total");
    if (ship_price>0 && disposal_qty>0){
        var sum=ship_price*disposal_qty;
        console.log(sum);
        document.getElementById("contract_amount").value=sum;
       
    }

}
var size_amount=0; 
var trip_rate=0;

    $(document).ready(function(){
	
	var addContractForm = $("#addContract");

       
	
        $('#ship_price').on('input',function(e){
        
             ship_price = $(this).val();
           
            if (ship_price>0){
                console.log("cal ship");
                calTotal();
            }
            });

        $('#disposal_qty').on('input',function(e){
    
  
             disposal_qty = $('#disposal_qty').val();
            if (disposal_qty>0){
                console.log("cal dispo")
                calTotal();
            }

        });
        $('#size_amount').change(async function(){ 
            size_amount =parseInt($(this).val());

            disposal_qty = $('#disposal_qty').val();
            
            if (size_amount>0 && disposal_qty>0){
                console.log("cal size");
                trip_rate=parseInt(disposal_qty/size_amount);
               $("#trip_rate").val(trip_rate); 
            }
        });

	// var validator = addContractForm.validate({
		
	// 	rules:{
	// 		first_name :{ required : true },
    //         last_name :{ required : true },
         
	// 	},
	// 	messages:{
	// 		first_name :{ required : "This field is required" },
    //         last_name :{ required : "This field is required" },
          
	// 	}
	// });
});
</script>