<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> รายงานลูกหนี้
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> รายงานลูกหนี้</a></li>
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
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">รายงานลูกหนี้</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="reportCost" name="reportCost" action="<?php echo base_url() ?>reportDebtorList" method="post" role="form">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="type">เลือกสรุปรายงาน</label>
                                <select class="form-control " id="type" name="type">
                                    <option value="1">รายวัน</option>
                                    <option value="2">รายเดือน</option>
                                    <option value="3">รายปี</option>
                                </select>
                            </div>
                            <div id="dayInput" style="display: block;">
                                <div class="form-group">
                                    <label for="day">เลือกวัน</label>
                                    <input type="text" class="form-control  day" readonly id="day" name="day" autocomplete="off">
                                </div>
                            </div>
                            <div id="monthInput" style="display: none;">
                                <div class="form-group">
                                    <label for="month">เลือกเดือน</label>
                                    <select class="form-control required" id="month" name="month">
                                        <option value="1">มกราคม</option>
                                        <option value="2">กุมภาพันธ์</option>
                                        <option value="3">มีนาคม</option>
                                        <option value="4">เมษายน</option>
                                        <option value="5">พฤษภาคม</option>
                                        <option value="6">มิถุนายน</option>
                                        <option value="7">กรกฎาคม</option>
                                        <option value="8">สิงหาคม</option>
                                        <option value="9">กันยายน</option>
                                        <option value="10">ตุลาคม</option>
                                        <option value="11">พฤศจิกายน</option>
                                        <option value="12">ธันวาคม</option>
                                    </select>
                                </div>
                            </div>
                            <div id="yearInput" style="display: none;">
                                <div class="form-group">
                                    <label for="year">ปี(ค.ศ.)</label>
                                    <input type="text" class="form-control required year" id="year" name="year" autocomplete="off">
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" id="submitBtn" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>


<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/jquery.datetimepicker.css">
<script type="text/javascript" src="<?= base_url() ?>assets/jquery.datetimepicker.js"></script>

<script>
    // function confirm(){
    //     const carno = document.getElementById('carno').value;
    //     const type = document.getElementById('type').value;
    //     var date = "";
    //     if(type === 1){
    //         date = document.getElementById('day').value;
    //     }
    //     else if(type === 2){
    //         date = document.getElementById('month').value;
    //     }else if(type === 3){ 
    //         date = document.getElementById('year').value;
    //      }
    //     $.ajax({
    //         url: baseURL + "reportCostList",
    //         type: "POST",
    //         data: {
    //             carno: carno,
    //             date: date,
    //         }, // Send the data as JSON
    //         dataType: "json",
    //         // success: function(response) {
    //         //     if(response.messages === "success"){
    //         //         window.location.href = "/reportCostList";
    //         //     }
    //         // },
    //         error: function(xhr, status, error) {
    //             // Handle any errors here
    //             console.error("AJAX error:", error);
    //         }
    //     })
    // }

    $(document).ready(function() {
        var dayPicker = jQuery('.day').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            lang: 'en',
            defaultDate: new Date()
        });
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        dayPicker.val(`${year}-${month}-${day}`);
        $('#submitBtn').click(function() {
            // Make #model input editable when the submit button is clicked
            $('#model').prop('readonly', false);
        });
        $("#reportCost").validate({

            rules: {
                model: {
                    required: true
                },
                carno: {
                    required: true
                },
                day: {
                    required: true
                },
                month: {
                    required: true
                },
                year: {
                    required: true
                },
            },
            messages: {
                model: {
                    required: "Please enter car "
                },
                carno: {
                    required: "Please enter car "
                },
                day: {
                    required: "Please enter a day "
                },
                month: {
                    required: "Please select a month "
                },
                year: {
                    required: "Please enter a year"
                },
            },
            submitHandler: function(form) {
                // Validation passed, make #model input editable


                // Now, you can submit the form or perform other actions
                form.submit();
            },
            invalidHandler: function(event, validator) {
                // Validation failed, make #model input readonly
                $('#model').prop('readonly', true);
            }
        });

        


        $("#type").change(function() {
            var selectedType = $(this).val();

            if (selectedType === "1") {
                // Show the day input
                $("#dayInput").show();
                // Hide the month and year inputs
                $("#day").val(`${year}-${month}-${day}`);
                $("#monthInput, #yearInput").hide();
            } else if (selectedType === "2") {
                // Show the month input
                $("#monthInput").show();
                // Hide the day and year inputs
                $("#dayInput, #yearInput").hide();
                $("#month").val(month);
            } else if (selectedType === "3") {
                // Show the year input
                $("#yearInput").show();
                // Hide the day and month inputs
                $("#dayInput, #monthInput").hide();
                $("#year").val(year);
            }
        });
        $("#type").trigger("change");
    });
</script>