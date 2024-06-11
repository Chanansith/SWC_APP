<?php
$model = "";
$carno = "";
$name = "";
$registerno = "";
$down = "";
$id = "";
if(!empty($downRecords)){
    foreach ($downRecords as $record) {
        $id = $record->id;
        $down = $record->down_balance;
        $carno = $record->carno;
        $model = $record->model;
        $name = $record->custname;
        $registerno = $record->registerno;
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> ลูกหนี้ค้างดาวน์
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('down') ?>"><i class="fa fa-dashboard"></i> ลูกหนี้ค้างดาวน์</a></li>
            <li><a href=""> แก้ไข</a></li>
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
                        <h3 class="box-title">ลูกหนี้ค้างดาวน์</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addCultivation" action="<?php echo base_url() ?>addNewCultivationMethod" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model">รถ</label>
                                        <input type="text" class="form-control required" readonly id="model" name="model" autocomplete="off" value="<?= $model?>" placeholder="Click to Search" data-toggle="modal" data-target="#searchModal">
                                        <input type="hidden" class="form-control required" id="carno" name="carno" value="<?= $carno?>" autocomplete="off">
                                        <input type="hidden" class="form-control required" id="id" name="id" value="<?= $id?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">ทะเบียน</label>
                                        <input type="text" class="form-control required" readonly id="registerno" name="registerno" value="<?= $registerno?>" autocomplete="off" data-toggle="modal" data-target="#searchModal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">ชื่อ</label>
                                        <input type="text" class="form-control required" readonly id="name" name="name" autocomplete="off" value="<?= $name?>" data-toggle="modal" data-target="#searchModal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="down">ยอดดาว</label>
                                        <input type="text" class="form-control required"  id="down" name="down" autocomplete="off" value="<?= $down?>">
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" value="Submit"  onclick="confirm()"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<div class="modal fade" id="searchModal" aria-hidden="true" aria-labelledby="searchModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ค้นหา</h4>
                <!-- <button class="close"></button> -->
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="ค้นหา" id="search" name="search" autocomplete="off">
                <ul class="list-group" id="searchList">

                </ul>
            </div>

        </div>
    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $('#summernote_eng').summernote();
    //     $('#summernote_lao').summernote();
    // });
    function selectSearch(carno, model, registerno, name, bank) {
        $("#carno").val(carno);
        $("#model").val(model);
        $("#name").val(name);
        $("#registerno").val(registerno);
        $("#searchModal").modal("hide");
    }
    function confirm() {
        const carno = document.getElementById('carno').value;
        const down = document.getElementById('down').value;
        const id = document.getElementById('id').value;
        $.ajax({
            url: baseURL + "editOldDown",
            type: "POST",
            data: {
                carno: carno,
                down: down,
                id:id
                // bank: bank,
            }, // Send the data as JSON
            dataType: "json",
            success: function(response) {
                if(response.messages === "success"){
                    window.location.href = "/down";
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors here
                console.error("AJAX error:", error);
            }
        })
    }
    $(document).ready(function() {
        const searchInput = document.getElementById('search');

        searchInput.addEventListener('input', function() {
            if (this.value.length >= 3) {
                console.log(searchInput.value);
                $.ajax({
                    url: baseURL + "searchCar",
                    type: "POST",
                    data: {
                        search: searchInput.value,
                    }, // Send the data as JSON
                    dataType: "json",
                    success: function(response) {
                        console.log("AJAX response:", response);
                        var html = "";
                        for (var i = 0; i < response.length; i++) {
                            html += '<li class="list-group-item" onclick="selectSearch(`' + response[i]['carno'] + '`,`' + response[i]['model'] + '`,`' + response[i]['registerno'] + '`,`' + response[i]['custname'] + '`,`' + response[i]['preparebank'] + '`)">';
                            html += response[i]['model'];
                            html += '  ทะเบียน : ';
                            html += response[i]['registerno'];
                            html += '</li>';
                        }
                        $("#searchList").html(html);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors here
                        console.error("AJAX error:", error);
                    }
                })
            }
        });
        
    });
</script>