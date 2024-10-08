
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> สัญญาจัดเก็บมูลฝอยติดเชื้อ:Contract for disposal IMW 
            <small></small>
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
                        <h3 class="box-title">สัญญาจัดเก็บมูลฝอยติดเชื้อ:Contract for disposal IMW</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addContract" action="<?php echo base_url_api ?>contract/create" method="post" role="form" >
                        <div class="box-body">
                        <div class="row">
                             
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">สัญญาเลขที่</label>
                                        <input type="text" class="form-control required" id="contract_code" name="contract_code" readonly value="<?php echo($contract_code)?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">วันที่เริ่ม</label>
                                        <input type="text" class="form-control date" id="contract_date" name="contract_date" required>
                                    </div>
                                </div>
                          
                            </div>
                            <div class="row">
                             
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">วันที่สิ้นสุด</label>
                                        <input type="text" class="form-control date" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date">เลือกแหล่งจำกัด/ศูนย์บำบัด</label>
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
                                        <label for="Contract_type">ราคากำจัดมูลฝอยติดเชื้อ</label>
                                        <input type="number" class="form-control required" id="ship_price" name="ship_price" value="0">
                                       บาท/กิโลกรัม 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Contract_type" style="text-align:left;"> บาท/กิโลกรัม </label>
                                       
                                      
                                    </div>
                                </div>
                            </div>
                          <div class="row">

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
                                        <label for="address">เจ้าหน้าที่ผู้ทำสัญญา</label>
                                        <input type="text" class="form-control required" id="contract_create_name" name="contract_create_name">
                                    </div>
                                </div>
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
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
    jQuery('#end_date').datetimepicker({
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