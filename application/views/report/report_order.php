<?php
$number = "";
$order_date_t = "";
$search_con = "";
$to_date_t = "";
if ($language == "en") {
      $order_date_t = $header[0]->en;
      $search_con = $header[1]->en;
      $to_date_t = $header[2]->en;
}
if ($language == "th") {
    $order_date_t = $header[0]->th;
      $search_con = $header[1]->th;
      $to_date_t = $header[2]->th;
}
if ($language == "lao") {
    $order_date_t = $header[0]->lao;
      $search_con = $header[1]->lao;
      $to_date_t = $header[2]->lao;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            echo 'Report Order';
            ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> main</a></li>
            <li><a href="<?php echo base_url('report_order') ?>"><i class="fa fa-dashboard"></i> Report Order</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= $search_con?></h3>
                    </div>
                    <div class="box-body">
                        <form id="SearchOrder" action="<?php echo base_url('report_order_list') ?>" method="POST" style="margin-top: 10px" target="_blank">

                            <div class="form-group">
                                <input type="radio" id="customer" name="order" value="checkcus" onchange="checkcus()">
                                <label>Customer</label>
                                <div style="display:none !important" id="customerShow">
                                    <select class="form-control" name="customer_id" id="customer_id" data-live-search="true">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach ($customer as $v) { ?>
                                            <option value="<?php echo $v->customer_id ?>" data-tokens="<?php echo $v->first_name ?> <?php echo $v->last_name  ?>"><?php echo $v->first_name  ?> <?php echo $v->last_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="radio" id="farmer" name="order" value="checkfarmer" onchange="checkfarmer()">
                                <label>Farmer</label>
                                <div style="display:none !important" id="farmerShow">
                                    <select class="form-control" name="farmer_id" id="farmer_id" data-live-search="true">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach ($farmer as $v) { ?>
                                            <option value="<?php echo $v->farmer_id ?>" data-tokens="<?php echo $v->first_name ?> <?php echo $v->last_name  ?>"><?php echo $v->first_name  ?> <?php echo $v->last_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date"><?= $order_date_t?></label>
                                <input type="text" class="form-control" id="order_date" name="order_date" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="to_order_date"><?= $to_date_t?></label>
                                <input type="text" class="form-control" id="to_order_date" name="to_order_date" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="margin-left: 3px;">ค้นหา</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Search Order Platform List</h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo base_url('report_order_platform_list') ?>" method="POST" style="margin-top: 10px" target="_blank">

                            <div class="form-group">
                                <input type="radio" id="customer_platform" name="platform" value="checkcus_platform" onchange="checkcus_platform()">
                                <label>Customer</label>
                                <div style="display:none !important" id="customerplatformShow">
                                    <select class="form-control" name="customer_id_platform" id="customer_id_platform" data-live-search="true">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach ($customer as $v) { ?>
                                            <option value="<?php echo $v->customer_id ?>" data-tokens="<?php echo $v->first_name ?> <?php echo $v->last_name  ?>"><?php echo $v->first_name  ?> <?php echo $v->last_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="radio" id="farmer_platform" name="platform" value="checkfarmer_platform" onchange="checkfarmer_platform()">
                                <label>Farmer</label>
                                <div style="display:none !important" id="farmerplatformShow">
                                    <select class="form-control" name="farmer_id_platform" id="farmer_id_platform" data-live-search="true">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach ($farmer as $v) { ?>
                                            <option value="<?php echo $v->farmer_id ?>" data-tokens="<?php echo $v->first_name ?> <?php echo $v->last_name  ?>"><?php echo $v->first_name  ?> <?php echo $v->last_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date_platform"><?= $order_date_t?></label>
                                <input type="text" class="form-control" id="order_date_platform" name="order_date_platform" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="to_order_date_platform"><?= $to_date_t?></label>
                                <input type="text" class="form-control" id="to_order_date_platform" name="to_order_date_platform" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="margin-left: 3px;">ค้นหา</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/jquery.datetimepicker.css">
<script type="text/javascript" src="<?= base_url() ?>assets/jquery.datetimepicker.js"></script>
<script type="text/javascript">
    $('#customer_id').selectpicker();
    $('#farmer_id').selectpicker();
    $('#customer_id_platform').selectpicker();
    $('#farmer_id_platform').selectpicker();
    jQuery('#order_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        lang: 'en'
    });
    jQuery('#order_date_platform').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        lang: 'en'
    });
    jQuery('#to_order_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        lang: 'en'
    });
    jQuery('#to_order_date_platform').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        lang: 'en'
    });
    function checkcus() {
        var checkbox = document.getElementById("customer");
        var show = document.getElementById("customerShow");
        var show2 = document.getElementById("farmerShow");
        if (checkbox.checked) {
            show.style.display = "block";
            show2.style.display = "none";
            $('#farmer_id').val('0');
            $('#customer_id').selectpicker('refresh');
        }
    }

    function checkfarmer() {
        var checkbox = document.getElementById("farmer");
        var show = document.getElementById("customerShow");
        var show2 = document.getElementById("farmerShow");
        if (checkbox.checked) {
            show.style.display = "none";
            show2.style.display = "block";
            $('#customer_id').val('0');
            $('#farmer_id').selectpicker('refresh');
        }
    }

    function checkcus_platform() {
        var checkbox = document.getElementById("customer_platform");
        var show = document.getElementById("customerplatformShow");
        var show2 = document.getElementById("farmerplatformShow");
        if (checkbox.checked) {
            show.style.display = "block";
            show2.style.display = "none";
            $('#farmer_id_platform').val('0');
            $('#customer_id_platform').selectpicker('refresh');
        }
    }

    function checkfarmer_platform() {
        var checkbox = document.getElementById("farmer_platform");
        var show = document.getElementById("customerplatformShow");
        var show2 = document.getElementById("farmerplatformShow");
        if (checkbox.checked) {
            show.style.display = "none";
            show2.style.display = "block";
            $('#customer_id_platform').val('0');
            $('#farmer_id_platform').selectpicker('refresh');
        }
    }
    $(document).ready(function() {
        $("#shopreportNav").addClass('active');

        var SearchOrderForm = $("#SearchOrder");

        var validator = SearchOrderForm.validate({

            rules: {
                order: {
                    required: true
                },
                platform: {
                    required: true
                },
            },
            messages: {
                order: {
                    required: "This field is required"
                },
                platform: {
                    required: "This field is required"
                },
            }
        });
    });
</script>