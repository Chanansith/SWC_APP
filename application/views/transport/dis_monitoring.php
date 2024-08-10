

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Request
      <small>Add, Edit, Delete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Request</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Request List</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
              <th>#</th>
                <th>Request By</th>
                <th>Contract Code</th>
                <th>Request Date</th>
                <th>Disposal</th>
              
                <th class="text-center">Actions</th>
              </tr>
              <?php
              if (!empty($monitoring_record)) {
                $i = 0;
                foreach ($monitoring_record as $record) {
                  $i++
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $record->companyname ?></td>
                    <td><?php echo $record->contract_code ?></td>
                    <td><?php echo $record->createon ?>  </td>
                    <td><?php echo $record->disposal_name ?>  </td>
              
                    <td class="text-center">
                    
                      <a class="btn btn-sm btn-info" href="<?php echo base_url_api . 'transport/addTransport/' . $record->requestid.'/'.$record->contract_id ?>"><i class="fa fa-plus"></i> Add Transport</a>
                     
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </table>

          </div><!-- /.box-body -->
         
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
   
  });
</script>