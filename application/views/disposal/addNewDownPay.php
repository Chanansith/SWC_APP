<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> ตัดจ่าย
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('downPay/'). $id  ?>"><i class="fa fa-dashboard"></i> ติดจ่าย</a></li>
            <li><a href=""> เพิ่ม</a></li>
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
                        <h3 class="box-title">เพิ่มตัดจ่าย</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addCultivation" action="<?php echo base_url() ?>addNewCultivationMethod" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="date">วันที่</label>
                                <input type="text" class="form-control required date" readonly id="date" name="date" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="date">จำนวน</label>
                                <input type="text" class="form-control required" id="cost" name="cost" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="type">ประเภท</label><br>
                                <input type="radio" id="type1" name="type" checked value="1">
                                <label for="type">เงินสด</label><br>
                                <input type="radio" id="type2" name="type" value="2">
                                <label for="type">เงินโอน</label><br>
                            </div>

                            <div class="form-group">
                                <label for="evidence">แนบหลักฐาน</label>
                                <input type="file" class="form-control-file" id="evidence">
                            </div>

                        </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <input type="button" class="btn btn-primary" value="Submit" onclick="confirm()" />
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
    function confirm() {
        var formData = new FormData();
        formData.append('image', $('#evidence')[0].files[0]);
        formData.append('date', document.getElementById('date').value);
        formData.append('cost', document.getElementById('cost').value);
        formData.append('type', $("input[name=type]:checked").val());
        formData.append('id', "<?= $id ?>");
        // const date = document.getElementById('date').value;
        // const cost = document.getElementById('cost').value;
        // const type = $("input[name=type]:checked").val();
        $.ajax({
            url: baseURL + "addNewDownPay",
            type: "POST",
            data: formData, // Send the data as JSON
            dataType: "json",
            contentType:false,
            processData:false,
            success: function(response) {
                if (response.messages === "success") {
                    window.location.href = "/downPay/<?= $id ?>";
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors here
                console.error("AJAX error:", error);
            }
        })
    }
    $(document).ready(function() {
        jQuery('.date').datetimepicker({
            timepicker: false,
            format: "Y/m/d"
        });
        // const searchInput = document.getElementById('search');

        // searchInput.addEventListener('input', function() {
        //     if (this.value.length >= 3) {
        //         console.log(searchInput.value);
        //         $.ajax({
        //             url: baseURL + "searchCar",
        //             type: "POST",
        //             data: {
        //                 search: searchInput.value,
        //             }, // Send the data as JSON
        //             dataType: "json",
        //             success: function(response) {
        //                 console.log("AJAX response:", response);
        //                 var html = "";
        //                 for (var i = 0; i < response.length; i++) {
        //                     html += '<li class="list-group-item" onclick="selectSearch(`' + response[i]['carno'] + '`,`' + response[i]['model'] + '`,`' + response[i]['registerno'] + '`,`' + response[i]['custname'] + '`,`' + response[i]['preparebank'] + '`)">';
        //                     html += response[i]['model'];
        //                     html += '  ทะเบียน : ';
        //                     html += response[i]['registerno'];
        //                     html += '</li>';
        //                 }
        //                 $("#searchList").html(html);
        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle any errors here
        //                 console.error("AJAX error:", error);
        //             }
        //         })
        //     }
        // });
        var addFarmForm = $("#addFarm");

        var validator = addFarmForm.validate({

            rules: {
                farm_name_la: {
                    required: true
                },
                farm_name_en: {
                    required: true
                },
                location: {
                    required: true
                },
                size: {
                    required: true
                },
            },
            messages: {
                farm_name_la: {
                    required: "This field is required"
                },
                farm_name_en: {
                    required: "This field is required"
                },
                location: {
                    required: "This field is required"
                },
                size: {
                    required: "This field is required"
                },
            }
        });
    });
</script>