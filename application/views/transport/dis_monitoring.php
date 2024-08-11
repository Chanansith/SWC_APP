

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Monitoring
     
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url_api.'transport' ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url_api.'transport' ?>">"> Monitoring</a></li>
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
            <h3 class="box-title">Monitoring</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
              <th>#</th>
                <th>imw status daily</th>
                <th>Max Per Day</th>
            
              
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
                    <td><?php echo $record->imw_status_daily ?></td>
                    <td><?php echo $record->max_per_day ?></td>
                 
              
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