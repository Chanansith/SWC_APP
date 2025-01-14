

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i>รายงานสรุปขยะติดเชื้อ
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Transportation and travel times</a></li>
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
            <h3 class="box-title">Transportation and travel times</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          From  <?php echo($source_name)?> To <?php echo($destination_name)?>
          <br>
          <div class="alert alert-info" id="traveltime"></div>
          <br>
          <div id="map"></div>
          </div><!-- /.box-body -->
         
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6HBpHxcgpVgxAcaVso4vYU9l-_WML5EM&libraries=places"></script>
   
<script type="text/javascript">
  jQuery(document).ready(function() {
   
  });
</script>

<script>




    </script>
