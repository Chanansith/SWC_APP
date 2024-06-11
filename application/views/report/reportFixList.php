<?php
$title = "";
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
            <i class="fa fa-users"></i> รายงานค่าใช้จ่ายงานซ่อม <?= $title ?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('down') ?>"><i class="fa fa-dashboard"></i> รายงานค่าใช้จ่ายงานซ่อม</a></li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">รายงานค่าใช้จ่ายงานซ่อม</h3>
                        <!-- <div class="box-tools">
                            <form action="<?php echo base_url() ?>reportDown/" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รถ</th>
                                <th>ทะเบียน</th>
                               
                                <th>ซ่อมภายใน</th>
                                <th>ซ่อมภายนอก</th>
                                <th>รวม</th>
                            </tr>
                            <?php
                            if (!empty($reportRecords)) {
                                $i = 0;

                                foreach ($reportRecords as $record) {
                                    $i++;
                                    $sumIn = 0;
                                    $sumOut = 0;
                                    $sum = 0;
                                    $date = 0;
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $record->model ?></td>
                                        <td><?php echo $record->registerno ?></td>
                                     
                                        <td><?php foreach ($record->fixIn as $in) {
                                                $sumIn = $sumIn + $in->cost;
                                            }
                                            echo $sumIn; ?></td>
                                        <td><?php foreach ($record->fixOut as $out) {
                                                $sumOut = $sumOut + $out->cost;
                                            }
                                            echo $sumOut; ?></td>
                                        <td><?= $sumIn + $sumOut ?></td>
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
</script>