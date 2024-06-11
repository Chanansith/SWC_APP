<?php
$title = "";
$sumcon = 0;
$sumregis = 0;
if (!empty($day)) {
  $title = "วันที่ " . $day;
}
if (!empty($month)) {
  if ($month === "1") {
    $title = "มกราคม";
  }
  if ($month === "2") {
    $title = "กุมภาพันธ์";
  }
  if ($month === "3") {
    $title = "มีนาคม";
  }
  if ($month === "4") {
    $title = "เมษายน";
  }
  if ($month === "5") {
    $title = "พฤษภาคม";
  }
  if ($month === "6") {
    $title = "มิถุนายน";
  }
  if ($month === "7") {
    $title = "กรกฎาคม";
  }
  if ($month === "8") {
    $title = "สิงหาคม";
  }
  if ($month === "9") {
    $title = "กันยายน";
  }
  if ($month === "10") {
    $title = "ตุลาคม";
  }
  if ($month === "11") {
    $title = "พฤศจิกายน";
  }
  if ($month === "12") {
    $title = "ธันวาคม";
  }
}
if (!empty($year)) {
  $title = "ปี " . $year;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> รายงาน <?= $title ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('reportCost') ?>"><i class="fa fa-dashboard"></i> รายงานค่าใช้จ่าย</a></li>
      <li><a href=""> รายงาน</a></li>
    </ol>
  </section>
  <section class="content">
    <?php if (!empty($carRecords[0])) { ?>
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>รถ: <?= $carRecords[0]->model ?></th>
                </tr>
                <tr>
                  <th>ทะเบียน: <?= $carRecords[0]->registerno ?></th>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">รายงานตรวจสภาพ</h3>
            <div class="box-tools">

            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>ลำดับ</th>
                <?php if (!empty($month) || !empty($year)) { ?>
                  <th>วันที่</th>
                <?php } ?>
                <th>รถ</th>
                <th>ทะเบียน</th>
                <th class="text-center">รวมตรวจสภาพ</th>

              </tr>
              <?php
              if (!empty($reportRecords['conditionCost'])) {
                $i = 0;
                foreach ($reportRecords['conditionCost'] as $record) {
                  $i++;
                  $sumcon = $sumcon + $record->inspection_fee + $record->condition_fee + $record->head_fee + $record->edit_cost + $record->cent_cost + $record->enginer_cost + $record->other;
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <?php if (!empty($month) || !empty($year)) { ?>
                      <td><?= $record->transfer_date?></td>
                    <?php } ?>
                    <td><?php echo $record->model ?></td>
                    <td><?php echo $record->registerno ?></td>
                    <td class="text-center"><?php echo $record->inspection_fee + $record->condition_fee + $record->head_fee + $record->edit_cost + $record->cent_cost + $record->enginer_cost + $record->other ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box -->
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">รายงานทะเบียน</h3>
            <div class="box-tools">

            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>ลำดับ</th>
                <?php if (!empty($month) || !empty($year)) { ?>
                  <th>วันที่</th>
                <?php } ?>
                <th>รถ</th>
                <th>ทะเบียน</th>
                <th class="text-center">รวมทะเบียน</th>

              </tr>
              <?php
              if (!empty($reportRecords['regisDepartCost'])) {
                $i = 0;
                foreach ($reportRecords['regisDepartCost'] as $record) {
                  $i++;
                  $sumregis = $sumregis + $record->regis_fee + $record->regis_pay_move + $record->regis_pay_tranfer + $record->regis_pay_storage  + $record->other;
              ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <?php if (!empty($month) || !empty($year)) { ?>
                      <td><?= $record->transfer_date?></td>
                    <?php } ?>
                    <td><?php echo $record->model ?></td>
                    <td><?php echo $record->registerno ?></td>
                    <td class="text-center"><?php echo $record->regis_fee + $record->regis_pay_move + $record->regis_pay_tranfer + $record->regis_pay_storage  + $record->other ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box -->
      </div>
      <div class="col-md-12 col-xs-12">
        <div class="box">
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>รวมตรวจสภาพทั้งหมด</th>
                <td><?php echo $sumcon ?></td>
                <th>รวมทะเบียนทั้งหมด</th>
                <td><?php echo $sumregis ?></td>
                <th>รวมทั้งหมด</th>
                <td><?php echo $sumcon + $sumregis ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  // jQuery('ul.pagination li a').click(function(e) {
  //   e.preventDefault();
  //   var link = jQuery(this).get(0).href;
  //   var value = link.substring(link.lastIndexOf('/') + 1);
  //   jQuery("#searchList").attr("action", baseURL + "cultivation/<?= $id ?>/" + value);
  //   jQuery("#searchList").submit();
  // });
</script>