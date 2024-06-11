<?php
$number = "";
$image = "";
$file = "";
$name = "";
$customer_name = "";
$address = "";
$contract_date_t = "";
$contract_time = "";
$contract_number_t = "";
$customer_contact_name = "";
$witness1_name = "";
$witness2_name = "";
if ($language == "en") {
  $number = $header[0]->en;
  $image = $header[1]->en;
  $file = $header[5]->en;
  $name = $header[3]->en;
  $customer_name = $header[4]->en;
  $address = $header[2]->en;
  $contract_date_t = $header[6]->en;
  $contract_time = $header[7]->en;
  $contract_number_t = $header[8]->en;
  $customer_contact_name = $header[9]->en;
  $witness1_name = $header[10]->en;
  $witness2_name = $header[11]->en;
}
if ($language == "th") {
  $number = $header[0]->th;
  $image = $header[1]->th;
  $file = $header[5]->th;
  $name = $header[3]->th;
  $customer_name = $header[4]->th;
  $address = $header[2]->th;
  $contract_date_t = $header[6]->th;
  $contract_time = $header[7]->th;
  $contract_number_t = $header[8]->th;
  $customer_contact_name = $header[9]->th;
  $witness1_name = $header[10]->th;
  $witness2_name = $header[11]->th;
}
if ($language == "lao") {
  $number = $header[0]->lao;
  $image = $header[1]->lao;
  $file = $header[5]->lao;
  $name = $header[3]->lao;
  $customer_name = $header[4]->lao;
  $address = $header[2]->lao;
  $contract_date_t = $header[6]->lao;
  $contract_time = $header[7]->lao;
  $contract_number_t = $header[8]->lao;
  $customer_contact_name = $header[9]->lao;
  $witness1_name = $header[10]->lao;
  $witness2_name = $header[11]->lao;
}

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Report Sign
      <!-- <small>Add, Edit, Delete</small> -->
    </h1>
  </section>
  <section class="content">
    <!-- <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>addWhyUs"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Report Sign List</h3>
            <div class="box-tools">
              <form action="<?php echo base_url() ?>report_sign" method="POST" id="searchList">
                <div class="input-group">
                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                  <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>"  />
                  <input type="hidden" name="contract_number" value="<?php echo $contract_number; ?>"  />
                  <input type="hidden" name="contract_date" value="<?php echo $contract_date; ?>"  />
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
                <th><?= $image?>/<?= $file?></th>
                <th><?= $customer_name?></th>
                <th><?= $name?></th>
                <th><?= $address?></th>
                <th><?= $contract_date_t?></th>
                <th><?= $contract_time?></th>
                <th><?= $contract_number_t?></th>
                <th><?= $customer_contact_name?></th>
                <th><?= $witness1_name?></th>
                <th><?= $witness2_name?></th>
                <!-- <th class="text-center">Actions</th> -->
              </tr>
              <?php
              if (!empty($signRecords)) {
                $i = 0;
                foreach ($signRecords as $record) {
                  $i++
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td style="text-align: center;">
                      <?php if($record->contract_image){
                        ?>
                      <img src="<?php echo base_url($record->contract_image) ?>" onclick="imagemodal(<?= $record->contract_id; ?>)" alt="Image" style="min-width: 200px;width:100%;height:150px;max-width:450px;">
                      <?php }if($record->filed_doc){ ?>
                        <a href="<?= base_url($record->filed_doc)?>">file</a>
                        <?php } ?>
                    </td>
                    <td><?php echo $record->first_name ?>  <?php echo $record->last_name ?></td>
                    <td><?php echo $record->admin_id ?></td>
                    <td><?php echo $record->address ?></td>
                    <td><?php echo $record->contract_date ?></td>
                    <td><?php echo $record->contract_time ?></td>
                    <td><?php echo $record->contract_number ?></td>
                    <td><?php echo $record->customer_name ?></td>
                    <td><?php echo $record->witness1_name ?></td>
                    <td><?php echo $record->witness2_name ?></td>
                    <!-- <td><?php echo $record->order_id ?></td> -->
                    <td class="text-center">
                      <!-- <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editContactrec/' . $record->contract_id; ?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger deleteContactrec" href="#" data-id="<?php echo $record->contract_id; ?>"><i class="fa fa-trash"></i></a> -->
                    </td>
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
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Image</h4>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="image">ID Agricultural</label>
          <img class="form-control" src="" id="image" alt="image" style="margin:auto;width:100%;height:300px;">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
      e.preventDefault();
      var link = jQuery(this).get(0).href;
      var value = link.substring(link.lastIndexOf('/') + 1);
      jQuery("#searchList").attr("action", baseURL + "report_sign/" + value);
      jQuery("#searchList").submit();
    });
  });
  function imagemodal(id) {
    $.ajax({
      url: baseURL + "getimage_sign",
      method: "POST",
      data: {
        id: id
      },
      datatype:"json",
      success: function(response) {
        var image = JSON.parse(response);
        $('#image').attr('src', baseURL+image.contract_image);
        $('#imageModal').modal('show');
      },
      error: function(xhr, status, error) {
        // การแสดงผลข้อผิดพลาด
        console.log(status);
        console.log(error);
      }
    })
  }
</script>