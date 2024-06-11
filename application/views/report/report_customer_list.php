<?php
$number = "";
$id_card = "";
$name = "";
$birthday = "";
$gender = "";
$nationality = "";
$customer_type = "";
$address = "";
if ($language == "en") {
  $number = $header[0]->en;
  $address =  $header[1]->en;
  $id_card =  $header[2]->en;
  $name =  $header[3]->en;
  $birthday =  $header[4]->en;
  $gender =  $header[7]->en;
  $nationality =  $header[8]->en;
  $customer_type =  $header[9]->en;
}
if ($language == "th") {
  $number = $header[0]->th;
  $address =  $header[1]->th;
  $id_card =  $header[2]->th;
  $name =  $header[3]->th;
  $birthday =  $header[4]->th;
  $gender =  $header[7]->th;
  $nationality =  $header[8]->th;
  $customer_type =  $header[9]->th;
}
if ($language == "lao") {
  $number = $header[0]->lao;
  $address =  $header[1]->lao;
  $id_card =  $header[2]->lao;
  $name =  $header[3]->lao;
  $birthday =  $header[4]->lao;
  $gender =  $header[7]->lao;
  $nationality =  $header[8]->lao;
  $customer_type =  $header[9]->lao;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Report Customer
      <!-- <small>Add, Edit, Delete</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('report_customer') ?>"> Search Report Customer</a></li>
      <li><a href="<?= base_url('report_customer_list') ?>"> Report Customer</a></li>
    </ol>
  </section>
  <section class="content">
    <!-- <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>addCustomer"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Report Customer List</h3>
            <div class="box-tools">
              <form action="<?php echo base_url() ?>customer" method="POST" id="searchList">
                <div class="input-group">
                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th><?= $number?></th>
                <th><?= $id_card?></th>
                <th><?= $name?></th>
                <th><?= $birthday?></th>
                <th><?= $gender?></th>
                <th><?= $nationality?></th>
                <th><?= $customer_type?></th>
                <th><?= $address ?></th>
                <!-- <th class="text-center">Actions</th> -->
              </tr>
              <?php
              if (!empty($customerRecords)) {
                $i = 0;
                foreach ($customerRecords as $record) {
                  $i++
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $record->id_card_number ?></td>
                    <td><?php echo $record->first_name ?>  <?php echo $record->last_name ?></td>
                    <td><?php echo $record->birth_date ?></td>
                    <td><?php 
                    if($record->gender == 0){
                        echo "ชาย" ;
                    }
                    if($record->gender == 1){
                        echo "หญิง" ;
                    }
                    ?></td>
                    <td><?php echo $record->nationality ?></td>
                    <td><?php echo $record->customer_type ?></td>
                    <td><?php echo $record->address ?></td>
                    <!-- <td class="text-center">
                      <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editCustomer/' . $record->customer_id; ?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger deleteCustomer" href="#" data-id="<?php echo $record->customer_id; ?>"><i class="fa fa-trash"></i></a>
                    </td> -->
                  </tr>
              <?php
                }
              }
              ?>
            </table>

          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
      e.preventDefault();
      var link = jQuery(this).get(0).href;
      var value = link.substring(link.lastIndexOf('/') + 1);
      jQuery("#searchList").attr("action", baseURL + "customer/" + value);
      jQuery("#searchList").submit();
    });
    jQuery(document).on("click", ".deleteCustomer", function() {
      var id = $(this).data("id"),
        hitURL = baseURL + "deleteCustomer",
        currentRow = $(this);
      var confirmation = confirm("Are you sure to delete this customer ?");
  
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
            alert("Customer successfully deleted");
          } else if (data.status = false) {
            alert("Customer deletion failed");
          } else {
            alert("Access denied..!");
          }
        });
      }
    });
  });
</script>