

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Contract
      <small>Add, Edit, Delete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Contract</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>contract/add"><i class="fa fa-plus"></i> เพิ่ม</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Contract List</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
              <th>#</th>
                <th>เลขที่สัญญา</th>
                <th>วันที่</th>
              
                <th>ปริมาณขยะ</th>
                <th>จำนวนเงินต่อสัญญา</th>
              
                <th class="text-center">Actions</th>
              </tr>
              <?php
              if (!empty($ContractRecords)) {
                $i = 0;
                foreach ($ContractRecords as $record) {
                  $i++
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $record->contract_code ?></td>
                    <td><?php echo $record->contract_date ?>  </td>
                    <td><?php echo $record->disposal_qty ?></td>
                 
                    <td><?php echo number_format($record->contract_amount,2) ?></td>
                    <td class="text-center">
                    <a class="btn btn-sm btn-warning" href="<?php echo base_url() . 'editContract/' . $record->id; ?>"><i class="fa fa-file"></i></a>
                      <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editContract/' . $record->id; ?>"><i class="fa fa-pencil"></i></a>
                     
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