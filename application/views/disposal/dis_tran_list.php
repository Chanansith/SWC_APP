

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Transport List
      <small>Add, Edit, Delete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Transport List</a></li>
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
            <h3 class="box-title">Transport List List</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
              <th>#</th>
              <th>Approve Status</th>
                <th>Transport Date</th>
                <th>Contract</th>
                <th>Disposal QTY</th>
                <th>Tranport By</th>
              
                <th class="text-center">Actions</th>
              </tr>
              <?php
              if (!empty($TranRecords)) {
                $i = 0;
                foreach ($TranRecords as $record) {
                  $i++
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td>
                    <?php if ($record->approve_status==0){?>
                     Waiting for Approve
                    <?php }?>
                    <?php if ($record->approve_status==1){?>
                     Pending
                    <?php }?>
                    <?php if ($record->approve_status==2){?>
                     Approved
                    <?php }?>
                    <?php if ($record->approve_status==3){?>
                     Received
                    <?php }?>
                </td>
                    <td><?php echo $record->tran_date ?></td>
                    <td><?php echo $record->companyname ?></br> <?php echo $record->contract_code ?></td>
                    <td><?php echo $record->disposal_qty ?>  </td>
                    <td><?php echo $record->full_name ?>  </td>
              
                    <td class="text-center">
                    <a class="btn btn-sm btn-success" href="<?php echo base_url_api . 'disposal/direction/'.$record->id.'/'.$record->contract_id ?>" target="_blank"><i class="fa fa-map-marker"></i>Travel Times</a>
                    <?php if ($record->approve_status<2){?>
                      <a class="btn btn-sm btn-success" href="<?php echo base_url_api . 'disposal/approveTransport/'.$record->id ?>"><i class="fa fa-check-circle"></i> Approve</a>
                      <a class="btn btn-sm btn-warning" href="<?php echo base_url_api . 'disposal/pendingTransport/'.$record->id ?>"><i class="fa fa-edit"></i> Pending</a>
                    <?php }?>
                    <?php if ($record->approve_status==2){?>
                      <a class="btn btn-sm btn-info" href="<?php echo base_url_api . 'disposal/receiveTransport/'.$record->disposal_qty.'/'.$record->id ?>"><i class="fa fa-check-circle"></i> Receive</a>
                     
                    <?php }?>
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