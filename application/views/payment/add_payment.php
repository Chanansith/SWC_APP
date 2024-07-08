
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

                    <form role="form" id="addContract" action="<?php echo base_url_api ?>contract/create" method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">วันที่</label>
                                        <input type="text" class="form-control date" id="contract_date" name="contract_date" readonly>
                                    </div>
                                </div>
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
                                        <label for="id_card_number">บริษัทขนส่ง</label>
                                        <?php 
                                       
                                        ?>
                                        <select class="form-control required" id="transportid" name="transportid">
                                        <?php
                                        foreach($transportlist as $trans){
                                          
                                             echo "<option value='".$trans->id."'>".$trans->full_name."</option>";
                                        }
                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date">แหล่งจำกัด/ศูนย์บำบัด</label>
                                        <select class="form-control required" id="disposalid" name="disposalid">
                                        <?php
                                        foreach($disposallist as $disp){
                                          
                                             echo "<option value='".$disp->id."'>".$disp->disposal_name."</option>";
                                        }
                                    ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Contract_type">ราคาค่าขนส่ง/ค่าจัดเก็บ</label>
                                        <input type="number" class="form-control required" id="ship_price" name="ship_price" value="0">
                                       บาท/กิโลกรัม 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">ปริมาณมูลฝอยติดเชื่อ</label>
                                        <input type="number" class="form-control required" id="disposal_qty" name="disposal_qty" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Contract_type">ขนาดรถบรรทุก</label>
                                        <select class="form-control required" id="size_amount" name="size_amount">
                                          <option value="0">--กรุณาเลือก--</option>
                                      <?php
                                        
                                        foreach($sizelist as $size){
                                          
                                             echo "<option value='".$size->size_amount."'>".$size->size_name."</option>";
                                        }
                                    ?>
                                        </select>
                                       kg (กิโลกรัม)
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">จำนวนเที่ยวรถที่ขนต่อสัญญา</label>
                                        <input type="number" class="form-control required" id="trip_rate" name="trip_rate" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Contract_type">จำนวนเงินต่อสัญญา</label>
                                        <input type="text" class="form-control required" id="contract_amount" name="contract_amount" readonly>
                                       บาท
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">เจ้าหน้าที่ผู้ทำสัญญา</label>
                                        <input type="text" class="form-control required" id="contract_create_name" name="contract_create_name">
                                    </div>
                                </div>
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Confirm" />
                            <input type="reset" class="btn btn-default" value="Reset" />
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
    jQuery('#contract_date').datetimepicker({
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