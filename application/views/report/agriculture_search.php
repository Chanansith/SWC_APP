<?php
$number = "";
$name = "";
$search_con = "";
if ($language == "en") {
  $number = $header[0]->en;
  $name = $header[1]->en;
  $search_con = $header[2]->en;
}
if ($language == "th") {
    $number = $header[0]->th;
    $name = $header[1]->th;
    $search_con = $header[2]->th;
}
if ($language == "lao") {
    $number = $header[0]->lao;
    $name = $header[1]->lao;
    $search_con = $header[2]->lao;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php
        echo 'Report Agriculture';
      ?>
    </h1>
    <!-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> main</a></li>
    </ol> -->
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
            <form action="<?php echo base_url('report_agriculture_list') ?>" method="POST" style="margin-top: 10px" target="_blank">
              
                <div class="form-group">
                  <label><?= $name;?></label>
                  <select class="form-control" name="farmer_id" id="farmer_id" data-live-search="true">
                    <option value="0" >ทั้งหมด</option>
                    <?php foreach ($farmer as $v) {?>
                    <option value="<?php echo $v->farmer_id ?>" data-tokens="<?php echo $v->first_name ?> <?php echo $v->last_name  ?>"><?php echo $v->first_name  ?> <?php echo $v->last_name ?></option>
                  <?php } ?>
                  </select>
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
<script type="text/javascript">

  $('#farmer_id').selectpicker();
  $(document).ready(function() {
    $("#shopreportNav").addClass('active');
  });
  
</script>