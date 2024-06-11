<?php
$number = "";
$customer_name = "";
$order_date_t = "";
$delivery_deadline = "";
$order_status = "";
$shipping_address = "";
$total_amount="";
if ($language == "en") {
  $number = $header[0]->en;
  $customer_name = $header[1]->en;
  $order_date_t = $header[2]->en;
  $delivery_deadline = $header[3]->en;
  $order_status = $header[4]->en;
  $shipping_address = $header[5]->en;
  $total_amount= $header[6]->en;
}
if ($language == "th") {
  $number = $header[0]->th;
  $customer_name = $header[1]->th;
  $order_date_t = $header[2]->th;
  $delivery_deadline = $header[3]->th;
  $order_status = $header[4]->th;
  $shipping_address = $header[5]->th;
  $total_amount= $header[6]->th;
}
if ($language == "lao") {
  $number = $header[0]->lao;
  $customer_name = $header[1]->lao;
  $order_date_t = $header[2]->lao;
  $delivery_deadline = $header[3]->lao;
  $order_status = $header[4]->lao;
  $shipping_address = $header[5]->lao;
  $total_amount= $header[6]->lao;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Order Platform
            <small>Add, Edit, Delete</small>
        </h1>
        <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('order_platform') ?>"> Order Platform</a></li>
    </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addOrder_platform"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Order Platform List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <table id="manageTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= $number?></th>
                                    <th><?= $customer_name?></th>
                                    <th><?= $order_date_t?></th>
                                    <th><?= $delivery_deadline?></th>
                                    <th><?= $order_status?></th>
                                    <th><?= $shipping_address?></th>
                                    <th><?= $total_amount?></th>
                                    <!-- <th>Harvest Schedule</th> -->
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<style>
    #manageTable_filter {
        text-align: right;
    }
</style>
<script type="text/javascript">
    var manageTable;
    $(document).ready(function() {
        manageTable = $('#manageTable').DataTable({
            ajax: {
                url: '<?= base_url() ?>report/fetchDataReportOrderPlatformList',
                data: {
                    order_date:'<?= $order_date ?>',
                    to_order_date:'<?= $to_order_date ?>',
                    customer_id:<?= $customer_id ?>,
                    farmer_id:<?= $farmer_id ?>
                },
            },
            'order': []
        });
        jQuery(document).on("click", ".alertContact", function() {
            alert("Confirm Order Status");
            
        });
        jQuery(document).on("click", ".deleteOrder_platform", function() {
            var id = $(this).data("id"),
                hitURL = baseURL + "deleteOrder_platform",
                currentRow = $(this);
            var confirmation = confirm("Are you sure to delete this Order Platform ?");

            if (confirmation) {
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: hitURL,
                    data: {
                        id: id
                    }
                }).done(function(data) {
                    console.log(data);
                    currentRow.parents('tr').remove();
                    if (data.status = true) {
                        alert("Order Platform successfully deleted");
                    } else if (data.status = false) {
                        alert("Order Platform deletion failed");
                    } else {
                        alert("Access denied..!");
                    }
                });
            }
        });
    })

    function performSearch() {
        var searchTerm = $('#searchInput').val();
        manageTable.search(searchTerm).draw();
    }
</script>